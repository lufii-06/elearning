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

        :root {
            --ink: #111827;
            --muted: #64748b;
            --line: #e2e8f0;
            --panel: #ffffff;
            --page: #f3f6fb;
            --brand: #14532d;
            --accent: #2563eb;
        }

        body {
            margin: 0;
            background: var(--page);
            color: var(--ink);
            font-family: Arial, sans-serif;
        }

        .app-shell {
            display: grid;
            grid-template-columns: 248px minmax(0, 1fr);
            min-height: 100vh;
        }

        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            padding: 24px 18px;
            background: #0f2f24;
            color: #ffffff;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
            padding: 8px;
        }

        .brand-mark {
            display: grid;
            width: 42px;
            height: 42px;
            place-items: center;
            border-radius: 8px;
            background: #fbbf24;
            color: #0f2f24;
            font-weight: 900;
        }

        .brand-name {
            margin: 0;
            font-size: 17px;
            font-weight: 900;
        }

        .brand-caption {
            margin: 2px 0 0;
            color: #bbd7cb;
            font-size: 12px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            min-height: 44px;
            padding: 0 12px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-weight: 800;
            text-decoration: none;
        }

        .content {
            min-width: 0;
            padding: 30px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
            font-size: 34px;
            letter-spacing: 0;
        }

        .subtitle {
            margin: 7px 0 0;
            color: var(--muted);
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 18px;
            align-items: start;
        }

        .panel,
        .info-panel {
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--panel);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
        }

        .panel {
            padding: 24px;
        }

        .info-panel {
            overflow: hidden;
        }

        .info-head {
            padding: 18px;
            background: #0f2f24;
            color: #ffffff;
        }

        .info-head h2 {
            margin: 0;
            font-size: 18px;
        }

        .info-body {
            padding: 18px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #edf2f7;
            color: #475569;
            font-weight: 800;
        }

        .info-row:last-child {
            border-bottom: 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 900;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fbfdff;
            color: var(--ink);
            font: inherit;
        }

        input:focus,
        textarea:focus {
            border-color: var(--accent);
            outline: 3px solid rgba(37, 99, 235, 0.13);
        }

        textarea {
            min-height: 136px;
            resize: vertical;
        }

        .field {
            margin-bottom: 18px;
        }

        .error {
            margin-top: 7px;
            color: #dc2626;
            font-size: 14px;
            font-weight: 800;
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
            border-radius: 8px;
            background: var(--accent);
            color: #ffffff;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
        }

        .button.secondary {
            background: #334155;
        }

        @media (max-width: 900px) {
            .app-shell,
            .layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
                height: auto;
            }

            .content {
                padding: 22px 16px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <div class="brand">
                <div class="brand-mark">SP</div>
                <div>
                    <p class="brand-name">Speaking Studio</p>
                    <p class="brand-caption">Admin panel</p>
                </div>
            </div>

            <a class="nav-link" href="{{ route('speaking.materials.index') }}">Materials</a>
        </aside>

        <main class="content">
            <div class="topbar">
                <div>
                    <h1>Tambah Materi</h1>
                    <p class="subtitle">Upload video dan PDF pendukung untuk materi speaking.</p>
                </div>
                <a class="button secondary" href="{{ route('speaking.materials.index') }}">Kembali</a>
            </div>

            <div class="layout">
                <form class="panel" action="{{ route('speaking.materials.store') }}" method="POST" enctype="multipart/form-data">
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
                        <button class="button" type="submit">Simpan Materi</button>
                        <a class="button secondary" href="{{ route('speaking.materials.index') }}">Batal</a>
                    </div>
                </form>

                <aside class="info-panel">
                    <div class="info-head">
                        <h2>Detail Upload</h2>
                    </div>
                    <div class="info-body">
                        <div class="info-row">
                            <span>Video</span>
                            <span>MP4/MOV/AVI</span>
                        </div>
                        <div class="info-row">
                            <span>PDF</span>
                            <span>Opsional</span>
                        </div>
                        <div class="info-row">
                            <span>Mode</span>
                            <span>Materi baru</span>
                        </div>
                    </div>
                </aside>
            </div>
        </main>
    </div>
</body>
</html>
