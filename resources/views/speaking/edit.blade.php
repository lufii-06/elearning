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

        :root {
            --bg: #f4f7fb;
            --panel: #ffffff;
            --ink: #17211f;
            --muted: #667085;
            --line: #dfe7e3;
            --sidebar: #102b25;
            --sidebar-2: #183b33;
            --brand: #2f6055;
            --accent: #2563eb;
            --danger: #c24135;
            --gold: #f4b942;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: Inter, Arial, sans-serif;
        }

        .app {
            display: grid;
            grid-template-columns: 280px minmax(0, 1fr);
            min-height: 100vh;
        }

        .sidebar {
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            padding: 22px 16px;
            background: linear-gradient(180deg, var(--sidebar), #0b211c);
            color: #ffffff;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 8px 22px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .brand-mark {
            display: grid;
            width: 44px;
            height: 44px;
            place-items: center;
            border-radius: 8px;
            background: var(--gold);
            color: #102b25;
            font-weight: 900;
        }

        .brand-title {
            margin: 0;
            font-size: 18px;
            font-weight: 900;
        }

        .brand-caption {
            margin: 3px 0 0;
            color: #b8d1ca;
            font-size: 12px;
        }

        .admin-card {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 18px 0;
            padding: 12px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.07);
        }

        .avatar {
            display: grid;
            width: 38px;
            height: 38px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 8px;
            background: #e8fff5;
            color: var(--sidebar);
            font-weight: 900;
        }

        .admin-name {
            margin: 0;
            font-size: 14px;
            font-weight: 900;
        }

        .admin-role {
            margin: 3px 0 0;
            color: #b8d1ca;
            font-size: 12px;
        }

        .nav-label {
            margin: 18px 10px 9px;
            color: #8fb3a8;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 0;
            text-transform: uppercase;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 46px;
            margin-bottom: 6px;
            padding: 0 12px;
            border-radius: 8px;
            color: #d9eee5;
            font-weight: 800;
            text-decoration: none;
        }

        .nav-link:hover,
        .nav-link.active {
            background: var(--sidebar-2);
            color: #ffffff;
        }

        .nav-icon {
            display: grid;
            width: 28px;
            height: 28px;
            place-items: center;
            border-radius: 7px;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-size: 11px;
            font-weight: 900;
        }

        .sidebar-footer {
            margin-top: auto;
            padding: 14px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.07);
        }

        .status-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            color: #d9eee5;
            font-size: 13px;
            font-weight: 800;
        }

        .status-dot {
            width: 9px;
            height: 9px;
            border-radius: 999px;
            background: #22c55e;
        }

        .main {
            min-width: 0;
            padding: 30px;
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
            color: var(--muted);
        }

        .layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 18px;
            align-items: start;
        }

        .panel,
        .side-panel {
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--panel);
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
            background: var(--brand);
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
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #fbfdfc;
        }

        .file-box + .file-box {
            margin-top: 12px;
        }

        .file-label {
            margin: 0 0 8px;
            color: var(--muted);
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
            border-color: var(--brand);
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
            color: var(--danger);
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
            background: var(--accent);
            color: #ffffff;
            font-weight: 900;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .button.secondary {
            background: var(--brand);
        }

        @media (max-width: 920px) {
            .app,
            .layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
                height: auto;
            }

            .main {
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
    <div class="app">
        <aside class="sidebar">
            <div class="brand">
                <div class="brand-mark">EL</div>
                <div>
                    <p class="brand-title">E-Learning</p>
                    <p class="brand-caption">Admin Console</p>
                </div>
            </div>

            <div class="admin-card">
                <div class="avatar">AD</div>
                <div>
                    <p class="admin-name">Admin Panel</p>
                    <p class="admin-role">Content Manager</p>
                </div>
            </div>

            <nav>
                <p class="nav-label">Main Menu</p>
                <a class="nav-link" href="{{ route('speaking.materials.index') }}">
                    <span class="nav-icon">DB</span>
                    <span>Dashboard</span>
                </a>
                <a class="nav-link active" href="{{ route('speaking.materials.index') }}">
                    <span class="nav-icon">SM</span>
                    <span>Speaking Materials</span>
                </a>
                <a class="nav-link" href="{{ route('speaking.materials.create') }}">
                    <span class="nav-icon">UP</span>
                    <span>Upload Materi</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="status-row">
                    <span>Storage public</span>
                    <span class="status-dot"></span>
                </div>
            </div>
        </aside>

        <main class="main">
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
    </div>
</body>
</html>
