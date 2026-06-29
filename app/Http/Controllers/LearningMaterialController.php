<?php

namespace App\Http\Controllers;

use App\Models\LearningMaterial;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LearningMaterialController extends Controller
{
    private function addFileUrls(LearningMaterial $material): LearningMaterial
    {
        $material->video_url = $material->video ? asset('storage/' . $material->video) : null;
        $material->audio_url = $material->audio ? asset('storage/' . $material->audio) : null;
        $material->pdf_url = $material->pdf ? asset('storage/' . $material->pdf) : null;
        $material->learning_guide_url = $material->learning_guide ? asset('storage/' . $material->learning_guide) : null;

        return $material;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = LearningMaterial::with('package')->get();

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
        $materials = LearningMaterial::where('kategori', $kategori)->with('package')->get();

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
     * Store a newly created resource in storage (API).
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'kategori' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,mov,avi',
            'audio' => 'nullable|mimes:mp3,wav,ogg,m4a,aac',
            'pdf' => 'nullable|mimes:pdf',
            'learning_guide' => 'nullable|mimes:pdf',
            'package_id' => 'nullable|exists:packages,id',
        ]);

        // ========================== VIDEO ==========================
        $video = $request->file('video')->store('videos', 'public');

        // ========================== AUDIO ==========================
        $audio = null;
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio')->store('audios', 'public');
        }

        // ========================== PDF ==========================
        $pdf = null;
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf')->store('pdfs', 'public');
        }

        // ========================== LEARNING GUIDE ==================
        $learningGuide = null;
        if ($request->hasFile('learning_guide')) {
            $learningGuide = $request->file('learning_guide')->store('learning_guides', 'public');
        }

        // =================== DATABASE ==================
        $material = LearningMaterial::create([
            'title' => $request->title,
            'description' => $request->description,
            'kategori' => $request->kategori,
            'video' => $video,
            'audio' => $audio,
            'pdf' => $pdf,
            'learning_guide' => $learningGuide,
            'package_id' => $request->package_id,
        ]);

        return response()->json([
            'message' => 'Materi berhasil upload',
            'data' => $this->addFileUrls($material)
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
        $packages = Package::orderBy('sort_order')->get();
        return view('learning.create', compact('packages'));
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
            'audio' => 'nullable|mimes:mp3,wav,ogg,m4a,aac',
            'pdf' => 'nullable|mimes:pdf',
            'learning_guide' => 'nullable|mimes:pdf',
            'package_id' => 'nullable|exists:packages,id',
        ]);

        // ========================== VIDEO ================
        $video = $request->file('video')->store('videos', 'public');

        // ========================== AUDIO ================
        $audio = null;
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio')->store('audios', 'public');
        }

        // ========================== PDF ====================
        $pdf = null;
        if ($request->hasFile('pdf')) {
            $pdf = $request->file('pdf')->store('pdfs', 'public');
        }

        // ========================== LEARNING GUIDE ====================
        $learningGuide = null;
        if ($request->hasFile('learning_guide')) {
            $learningGuide = $request->file('learning_guide')->store('learning_guides', 'public');
        }

        // =================== DATABASE ==================
        LearningMaterial::create([
            'title' => $request->title,
            'description' => $request->description,
            'kategori' => $request->kategori,
            'video' => $video,
            'audio' => $audio,
            'pdf' => $pdf,
            'learning_guide' => $learningGuide,
            'package_id' => $request->package_id,
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
        $materials = LearningMaterial::with('package')->latest()->get();

        return view('learning.index', compact('materials'));
    }

    // ======================
    // HALAMAN EDIT MATERIAL WEB
    // ======================
    public function editWeb(string $id)
    {
        $material = LearningMaterial::findOrFail($id);
        $packages = Package::orderBy('sort_order')->get();

        return view('learning.edit', compact('material', 'packages'));
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
            'audio' => 'nullable|mimes:mp3,wav,ogg,m4a,aac',
            'pdf' => 'nullable|mimes:pdf',
            'learning_guide' => 'nullable|mimes:pdf',
            'package_id' => 'nullable|exists:packages,id',
        ]);

        if ($request->hasFile('video')) {
            if ($material->video) {
                Storage::disk('public')->delete($material->video);
            }
            $data['video'] = $request->file('video')->store('videos', 'public');
        }

        if ($request->hasFile('audio')) {
            if ($material->audio) {
                Storage::disk('public')->delete($material->audio);
            }
            $data['audio'] = $request->file('audio')->store('audios', 'public');
        }

        if ($request->hasFile('pdf')) {
            if ($material->pdf) {
                Storage::disk('public')->delete($material->pdf);
            }
            $data['pdf'] = $request->file('pdf')->store('pdfs', 'public');
        }

        if ($request->hasFile('learning_guide')) {
            if ($material->learning_guide) {
                Storage::disk('public')->delete($material->learning_guide);
            }
            $data['learning_guide'] = $request->file('learning_guide')->store('learning_guides', 'public');
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

        if ($material->audio) {
            Storage::disk('public')->delete($material->audio);
        }

        if ($material->pdf) {
            Storage::disk('public')->delete($material->pdf);
        }

        if ($material->learning_guide) {
            Storage::disk('public')->delete($material->learning_guide);
        }

        $material->delete();

        return redirect()
            ->route('learning.materials.index')
            ->with('success', 'Materi berhasil dihapus');
    }

    /**
     * Display the specified resource (API).
     */
    public function show(string $id)
    {
        $material = LearningMaterial::with('package')->find($id);

        if (!$material) {
            return response()->json(['message' => 'Materi learning tidak ketemu'], 404);
        }

        return response()->json($this->addFileUrls($material));
    }

    /**
     * Update the specified resource in storage (API).
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
            'audio' => ['nullable', 'mimes:mp3,wav,ogg,m4a,aac'],
            'pdf' => ['nullable', 'mimes:pdf'],
            'learning_guide' => ['nullable', 'mimes:pdf'],
            'package_id' => ['nullable', 'exists:packages,id'],
        ]);

        if ($request->hasFile('video')) {
            if ($material->video) {
                Storage::disk('public')->delete($material->video);
            }
            $data['video'] = $request->file('video')->store('videos', 'public');
        }

        if ($request->hasFile('audio')) {
            if ($material->audio) {
                Storage::disk('public')->delete($material->audio);
            }
            $data['audio'] = $request->file('audio')->store('audios', 'public');
        }

        if ($request->hasFile('pdf')) {
            if ($material->pdf) {
                Storage::disk('public')->delete($material->pdf);
            }
            $data['pdf'] = $request->file('pdf')->store('pdfs', 'public');
        }

        if ($request->hasFile('learning_guide')) {
            if ($material->learning_guide) {
                Storage::disk('public')->delete($material->learning_guide);
            }
            $data['learning_guide'] = $request->file('learning_guide')->store('learning_guides', 'public');
        }

        $material->update($data);

        return response()->json([
            'message' => 'Materi learning berhasil UPDATE!',
            'data' => $this->addFileUrls($material),
        ]);
    }

    /**
     * Remove the specified resource from storage (API).
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

        if ($material->audio) {
            Storage::disk('public')->delete($material->audio);
        }

        if ($material->pdf) {
            Storage::disk('public')->delete($material->pdf);
        }

        if ($material->learning_guide) {
            Storage::disk('public')->delete($material->learning_guide);
        }

        $material->delete();

        return response()->json(['message' => 'Materi learning berhasil dihapus']);
    }
}

