<?php

namespace App\Http\Controllers;

use App\Models\LearningMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LearningMaterialController extends Controller
{
    private function addFileUrls(LearningMaterial $material): LearningMaterial
    {
        $material->video_url = $material->video ? asset('storage/' . $material->video) : null;
        $material->pdf_url = $material->pdf ? asset('storage/' . $material->pdf) : null;

        return $material;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = LearningMaterial::all();

        foreach ($materials as $item) {
            $this->addFileUrls($item);
        }

        return response()->json($materials);
    }

    // ======================
    // API FILTER BERDASARKAN KATEGORI
    // ======================
    public function byCategory(string $kategori)
    {
        $materials = LearningMaterial::where('kategori', $kategori)->get();

        foreach ($materials as $item) {
            $this->addFileUrls($item);
        }

        return response()->json($materials);
    }

    // ======================
    // API LIST KATEGORI
    // ======================
    public function categories()
    {
        $categories = LearningMaterial::query()
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'kategori' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,avi',
            'pdf' => 'nullable|mimes:pdf'
        ]);

        // ========================== VIDEO ==========================
        $video = $request->file('video')->store('videos', 'public');

        // ========================== PDF ==========================
        $pdf = null;

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf')->store('pdfs', 'public');
        }

        // =================== DATABASE ==================
        $material = LearningMaterial::create([
            'title' => $request->title,
            'description' => $request->description,
            'kategori' => $request->kategori,
            'video' => $video,
            'pdf' => $pdf,
        ]);

        return response()->json([
            'message' => 'Materi berhasil upload',
            'data' => $material
        ]);
    }

    // ======================
    // API SAVE PROGRESS
    // ======================
    public function saveProgress(Request $request)
    {
        return response()->json([
            'message' => 'Progress berhasil disimpan'
        ]);
    }

    // ======================
    // HALAMAN FORM UPLOAD
    // ======================
    public function create()
    {
        return view('learning.create');
    }

    // ======================
    // UPLOAD DARI WEB
    // ======================
    public function storeWeb(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'kategori' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,avi',
            'pdf' => 'nullable|mimes:pdf'
        ]);

        // ========================== VIDEO ================
        $video = $request->file('video')->store('videos', 'public');

        // ========================== PDF ====================
        $pdf = null;

        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf')->store('pdfs', 'public');
        }

        // =================== DATABASE ==================
        LearningMaterial::create([
            'title' => $request->title,
            'description' => $request->description,
            'kategori' => $request->kategori,
            'video' => $video,
            'pdf' => $pdf,
        ]);

        return redirect()
            ->route('learning.materials.index')
            ->with('success', 'Materi berhasil upload');
    }

    // ======================
    // LIST MATERIAL WEB
    // ======================
    public function materials()
    {
        $materials = LearningMaterial::latest()->get();

        return view('learning.index', compact('materials'));
    }

    // ======================
    // HALAMAN EDIT MATERIAL WEB
    // ======================
    public function editWeb(string $id)
    {
        $material = LearningMaterial::findOrFail($id);

        return view('learning.edit', compact('material'));
    }

    // ======================
    // UPDATE DARI WEB
    // ======================
    public function updateWeb(Request $request, string $id)
    {
        $material = LearningMaterial::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'kategori' => 'required|string|max:255',
            'video' => 'nullable|mimes:mp4,mov,avi',
            'pdf' => 'nullable|mimes:pdf',
        ]);

        if ($request->hasFile('video')) {
            if ($material->video) {
                Storage::disk('public')->delete($material->video);
            }

            $data['video'] = $request->file('video')->store('videos', 'public');
        }

        if ($request->hasFile('pdf')) {
            if ($material->pdf) {
                Storage::disk('public')->delete($material->pdf);
            }

            $data['pdf'] = $request->file('pdf')->store('pdfs', 'public');
        }

        $material->update($data);

        return redirect()
            ->route('learning.materials.index')
            ->with('success', 'Materi berhasil diupdate');
    }

    // ======================
    // HAPUS DARI WEB
    // ======================
    public function destroyWeb(string $id)
    {
        $material = LearningMaterial::findOrFail($id);

        if ($material->video) {
            Storage::disk('public')->delete($material->video);
        }

        if ($material->pdf) {
            Storage::disk('public')->delete($material->pdf);
        }

        $material->delete();

        return redirect()
            ->route('learning.materials.index')
            ->with('success', 'Materi berhasil dihapus');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $material = LearningMaterial::find($id);

        if (!$material) {
            return response()->json(['message' => 'Materi learning tidak ketemu'], 404);
        }

        return response()->json($this->addFileUrls($material));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $material = LearningMaterial::find($id);

        if (!$material) {
            return response()->json(['message' => 'Materi learning tidak ketemu'], 404);
        }

        $data = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'kategori' => ['sometimes', 'required', 'string', 'max:255'],
            'video' => ['nullable', 'mimes:mp4,mov,avi'],
            'pdf' => ['nullable', 'mimes:pdf'],
        ]);

        if ($request->hasFile('video')) {
            if ($material->video) {
                Storage::disk('public')->delete($material->video);
            }

            $data['video'] = $request->file('video')->store('videos', 'public');
        }

        if ($request->hasFile('pdf')) {
            if ($material->pdf) {
                Storage::disk('public')->delete($material->pdf);
            }

            $data['pdf'] = $request->file('pdf')->store('pdfs', 'public');
        }

        $material->update($data);

        return response()->json([
            'message' => 'Materi learning berhasil UPDATE!',
            'data' => $this->addFileUrls($material),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $material = LearningMaterial::find($id);

        if (!$material) {
            return response()->json(['message' => 'Materi learning tidak ketemu'], 404);
        }

        if ($material->video) {
            Storage::disk('public')->delete($material->video);
        }

        if ($material->pdf) {
            Storage::disk('public')->delete($material->pdf);
        }

        $material->delete();

        return response()->json(['message' => 'Materi learning berhasil dihapus']);
    }
}
