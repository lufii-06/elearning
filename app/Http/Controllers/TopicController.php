<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        return response()->json(Topic::all());
    }

    public function show(string $id)
    {
        $topic = Topic::find($id);

        if (!$topic) {
            return response()->json(['message' => 'Topic tidak ketemu'], 404);
        }

        return response()->json($topic);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'is_free' => ['nullable', 'boolean'],
        ]);

        $topic = Topic::create($data);

        return response()->json([
            'message' => 'Topic berhasil DITAMBAH!',
            'data' => $topic,
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        $topic = Topic::find($id);

        if (!$topic) {
            return response()->json(['message' => 'Topic tidak ketemu'], 404);
        }

        $data = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'is_free' => ['nullable', 'boolean'],
        ]);

        $topic->update($data);

        return response()->json([
            'message' => 'Topic berhasil UPDATE!',
            'data' => $topic,
        ]);
    }

    public function destroy(string $id)
    {
        $topic = Topic::find($id);

        if (!$topic) {
            return response()->json(['message' => 'Topic tidak ketemu'], 404);
        }

        $topic->delete();

        return response()->json(['message' => 'Topic berhasil dihapus']);
    }
}
