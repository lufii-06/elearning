<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Speaking Material</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            color: #1f2937;
            font-family: Arial, sans-serif;
        }

        .page {
            width: min(760px, calc(100% - 32px));
            margin: 32px auto;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
            font-size: 28px;
        }

        .form-panel {
            padding: 24px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #ffffff;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
        }

        input,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font: inherit;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .field {
            margin-bottom: 18px;
        }

        .error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 10px 14px;
            border: 0;
            border-radius: 6px;
            background: #2563eb;
            color: #ffffff;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .button.secondary {
            background: #475569;
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="header">
            <h1>Tambah Materi</h1>
            <a class="button secondary" href="{{ route('speaking.materials.index') }}">Kembali</a>
        </div>

        <form class="form-panel" action="{{ route('speaking.materials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label for="title">Judul</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="video">Video</label>
                <input id="video" type="file" name="video" accept=".mp4,.mov,.avi" required>
                @error('video')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="pdf">PDF</label>
                <input id="pdf" type="file" name="pdf" accept=".pdf">
                @error('pdf')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="actions">
                <button class="button" type="submit">Simpan</button>
                <a class="button secondary" href="{{ route('speaking.materials.index') }}">Batal</a>
            </div>
        </form>
    </main>
</body>
</html>
