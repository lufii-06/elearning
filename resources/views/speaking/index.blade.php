<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speaking Studio</title>
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

        a {
            color: inherit;
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

        .nav-group {
            margin-top: 4px;
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

        .nav-spacer {
            flex: 1;
        }

        .nav-badge {
            padding: 4px 8px;
            border-radius: 999px;
            background: rgba(244, 185, 66, 0.18);
            color: #ffe2a3;
            font-size: 12px;
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
            gap: 18px;
            margin-bottom: 24px;
        }

        h1 {
            margin: 0;
            font-size: clamp(28px, 4vw, 42px);
            letter-spacing: 0;
        }

        .subtitle {
            margin: 8px 0 0;
            color: var(--muted);
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
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .button.secondary {
            background: var(--brand);
        }

        .button.danger {
            background: var(--danger);
        }

        .alert {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-left: 5px solid #2f9e44;
            border-radius: 8px;
            background: #ffffff;
            color: #1c6b35;
            font-weight: 800;
            box-shadow: 0 12px 30px rgba(31, 41, 55, 0.06);
        }

        .table-card {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--panel);
            box-shadow: 0 18px 40px rgba(31, 41, 55, 0.08);
        }

        .table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 18px;
            border-bottom: 1px solid var(--line);
        }

        .table-title {
            margin: 0;
            font-size: 18px;
        }

        .table-count {
            color: var(--muted);
            font-weight: 800;
        }

        .table-scroll {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 16px 18px;
            border-bottom: 1px solid #edf1ef;
            text-align: left;
            vertical-align: top;
        }

        th {
            color: var(--muted);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0;
            text-transform: uppercase;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .title-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 220px;
        }

        .row-number {
            display: grid;
            width: 34px;
            height: 34px;
            flex: 0 0 auto;
            place-items: center;
            border-radius: 8px;
            background: #e9f5f1;
            color: var(--brand);
            font-weight: 900;
        }

        .material-title {
            margin: 0;
            font-weight: 900;
        }

        .description {
            max-width: 360px;
            color: #566963;
            line-height: 1.55;
        }

        .file-pill {
            display: inline-flex;
            align-items: center;
            min-height: 34px;
            padding: 7px 11px;
            border-radius: 8px;
            background: #f0f7ff;
            color: #1d4ed8;
            font-weight: 900;
            text-decoration: none;
        }

        .file-pill.pdf {
            background: #fff5e5;
            color: #9a5b00;
        }

        .muted {
            color: #9ca9a5;
            font-weight: 700;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .empty {
            padding: 46px 20px;
            text-align: center;
            color: var(--muted);
            font-weight: 800;
        }

        @media (max-width: 920px) {
            .app {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
                height: auto;
            }

            .main {
                padding: 22px 16px;
            }

            .topbar,
            .table-toolbar {
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

            <nav class="nav-group">
                <p class="nav-label">Main Menu</p>
                <a class="nav-link" href="{{ route('speaking.materials.index') }}">
                    <span class="nav-icon">DB</span>
                    <span>Dashboard</span>
                </a>
                <a class="nav-link active" href="{{ route('speaking.materials.index') }}">
                    <span class="nav-icon">SM</span>
                    <span>Speaking Materials</span>
                    <span class="nav-spacer"></span>
                    <span class="nav-badge">{{ $materials->count() }}</span>
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
                    <h1>Speaking Materials</h1>
                    <p class="subtitle">Kelola koleksi video pembelajaran dan dokumen pendukung.</p>
                </div>

                <a class="button" href="{{ route('speaking.materials.create') }}">Tambah Materi</a>
            </div>

            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            <section class="table-card">
                <div class="table-toolbar">
                    <h2 class="table-title">Daftar Materi</h2>
                    <span class="table-count">{{ $materials->count() }} item</span>
                </div>

                @if ($materials->isEmpty())
                    <div class="empty">Belum ada materi speaking.</div>
                @else
                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th>Materi</th>
                                    <th>Deskripsi</th>
                                    <th>Video</th>
                                    <th>PDF</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materials as $material)
                                    <tr>
                                        <td>
                                            <div class="title-cell">
                                                <span class="row-number">{{ $loop->iteration }}</span>
                                                <p class="material-title">{{ $material->title }}</p>
                                            </div>
                                        </td>
                                        <td class="description">{{ $material->description ?: '-' }}</td>
                                        <td>
                                            @if ($material->video)
                                                <a class="file-pill" href="{{ asset('storage/' . $material->video) }}" target="_blank">Video</a>
                                            @else
                                                <span class="muted">Kosong</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($material->pdf)
                                                <a class="file-pill pdf" href="{{ asset('storage/' . $material->pdf) }}" target="_blank">PDF</a>
                                            @else
                                                <span class="muted">Kosong</span>
                                            @endif
                                        </td>
                                        <td>{{ $material->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="actions">
                                                <a class="button secondary" href="{{ route('speaking.materials.edit', $material->id) }}">Edit</a>
                                                <form action="{{ route('speaking.materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="button danger" type="submit">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </section>
        </main>
    </div>
</body>
</html>
