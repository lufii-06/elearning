<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Speaking Material</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #eef2f3;
            color: #17211f;
            font-family: Inter, Arial, sans-serif;
        }

        .page {
            width: min(1040px, calc(100% - 32px));
            margin: 30px auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
        }

        h1 {
            margin: 0;
            font-size: clamp(28px, 4vw, 40px);
            letter-spacing: 0;
        }

        .subtitle {
            margin: 8px 0 0;
            color: #5c6f69;
        }

        .layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 18px;
            align-items: start;
        }

        .panel,
        .side-panel {
            border: 1px solid #d7dedb;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 18px 40px rgba(31, 41, 55, 0.08);
        }

        .panel {
            padding: 24px;
        }

        .side-panel {
            overflow: hidden;
        }

        .side-head {
            padding: 18px;
            background: #17352f;
            color: #ffffff;
        }

        .side-head h2 {
            margin: 0;
            font-size: 18px;
        }

        .side-body {
            padding: 18px;
        }

        .file-box {
            padding: 14px;
            border: 1px solid #dfe7e3;
            border-radius: 8px;
            background: #fbfdfc;
        }

        .file-box + .file-box {
            margin-top: 12px;
        }

        .file-label {
            margin: 0 0 8px;
            color: #62746f;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .file-link {
            color: #1d4ed8;
            font-weight: 900;
            text-decoration: none;
        }

        .muted {
            color: #9ca9a5;
            font-weight: 800;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #263b36;
            font-weight: 900;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #cbd8d3;
            border-radius: 8px;
            background: #fbfdfc;
            color: #17211f;
            font: inherit;
        }

        input:focus,
        textarea:focus {
            border-color: #2f6055;
            outline: 3px solid rgba(47, 96, 85, 0.14);
        }

        textarea {
            min-height: 140px;
            resize: vertical;
        }

        .field {
            margin-bottom: 18px;
        }

        .error {
            margin-top: 7px;
            color: #c24135;
            font-size: 14px;
            font-weight: 800;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 6px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 10px 16px;
            border: 0;
            border-radius: 8px;
            background: #2563eb;
            color: #ffffff;
            font-weight: 900;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .button.secondary {
            background: #2f6055;
        }

        @media (max-width: 880px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .layout {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="topbar">
            <div>
                <h1>Edit Materi</h1>
                <p class="subtitle">{{ $material->title }}</p>
            </div>

            <a class="button secondary" href="{{ route('speaking.materials.index') }}">Kembali</a>
        </div>

        <div class="layout">
            <form class="panel" action="{{ route('speaking.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="field">
                    <label for="title">Judul</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $material->title) }}" required>
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description">{{ old('description', $material->description) }}</textarea>
                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="video">Video Baru</label>
                    <input id="video" type="file" name="video" accept=".mp4,.mov,.avi">
                    @error('video')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label for="pdf">PDF Baru</label>
                    <input id="pdf" type="file" name="pdf" accept=".pdf">
                    @error('pdf')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="actions">
                    <button class="button" type="submit">Update Materi</button>
                    <a class="button secondary" href="{{ route('speaking.materials.index') }}">Batal</a>
                </div>
            </form>

            <aside class="side-panel">
                <div class="side-head">
                    <h2>File Saat Ini</h2>
                </div>
                <div class="side-body">
                    <div class="file-box">
                        <p class="file-label">Video</p>
                        @if ($material->video)
                            <a class="file-link" href="{{ asset('storage/' . $material->video) }}" target="_blank">Buka video</a>
                        @else
                            <span class="muted">Belum ada video</span>
                        @endif
                    </div>

                    <div class="file-box">
                        <p class="file-label">PDF</p>
                        @if ($material->pdf)
                            <a class="file-link" href="{{ asset('storage/' . $material->pdf) }}" target="_blank">Buka PDF</a>
                        @else
                            <span class="muted">Belum ada PDF</span>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </main>
</body>
</html>
