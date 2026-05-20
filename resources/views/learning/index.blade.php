<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Materials</title>
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
            --brand-soft: #dcfce7;
            --accent: #2563eb;
            --warn: #b45309;
            --danger: #dc2626;
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

        .nav-label {
            margin: 0 8px 10px;
            color: #92b8a8;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .nav-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 44px;
            padding: 0 12px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-weight: 800;
            text-decoration: none;
        }

        .sidebar-note {
            margin-top: 24px;
            padding: 14px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 8px;
            color: #d9eee5;
            font-size: 13px;
            line-height: 1.5;
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
            line-height: 1.5;
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
            white-space: nowrap;
        }

        .button.secondary {
            background: #334155;
        }

        .button.danger {
            background: var(--danger);
        }

        .alert {
            margin-bottom: 16px;
            padding: 13px 14px;
            border: 1px solid #bbf7d0;
            border-left: 5px solid #16a34a;
            border-radius: 8px;
            background: #f0fdf4;
            color: #166534;
            font-weight: 800;
        }

        .summary-strip {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 16px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            min-height: 34px;
            padding: 7px 11px;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: #ffffff;
            color: #475569;
            font-weight: 800;
        }

        .table-card {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 8px;
            background: var(--panel);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
        }

        .table-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
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

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px 18px;
            border-bottom: 1px solid #edf2f7;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #f8fafc;
            color: #475569;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .material {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .number {
            display: grid;
            width: 34px;
            height: 34px;
            place-items: center;
            border-radius: 8px;
            background: var(--brand-soft);
            color: var(--brand);
            font-weight: 900;
        }

        .material-title {
            margin: 0;
            font-weight: 900;
        }

        .description {
            max-width: 360px;
            color: #526173;
            line-height: 1.5;
        }

        .file-link {
            display: inline-flex;
            min-height: 34px;
            align-items: center;
            padding: 7px 11px;
            border-radius: 8px;
            background: #eff6ff;
            color: #1d4ed8;
            font-weight: 900;
            text-decoration: none;
        }

        .file-link.pdf {
            background: #fffbeb;
            color: var(--warn);
        }

        .category-pill {
            display: inline-flex;
            min-height: 30px;
            align-items: center;
            padding: 6px 10px;
            border-radius: 999px;
            background: var(--brand-soft);
            color: var(--brand);
            font-weight: 900;
            white-space: nowrap;
        }

        .muted {
            color: #94a3b8;
            font-weight: 700;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .empty {
            padding: 44px 18px;
            text-align: center;
            color: var(--muted);
            font-weight: 800;
        }

        @media (max-width: 860px) {
            .app-shell {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
                height: auto;
            }

            .content {
                padding: 22px 16px;
            }

            .topbar,
            .table-head {
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
                    <p class="brand-name">Learning Studio</p>
                    <p class="brand-caption">Admin panel</p>
                </div>
            </div>

            <p class="nav-label">Menu</p>
            <a class="nav-link" href="{{ route('learning.materials.index') }}">
                <span>Materials</span>
                <span>{{ $materials->count() }}</span>
            </a>

            <div class="sidebar-note">Upload video learning dan PDF pendukung dari satu tempat yang rapi.</div>
        </aside>

        <main class="content">
            <div class="topbar">
                <div>
                    <h1>Learning Materials</h1>
                    <p class="subtitle">Kelola video pembelajaran, dokumen PDF, dan deskripsi materi learning.</p>
                </div>

                <a class="button" href="{{ route('learning.materials.create') }}">Tambah Materi</a>
            </div>

            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            <div class="summary-strip">
                <span class="chip">{{ $materials->count() }} materi</span>
                <span class="chip">{{ $materials->whereNotNull('video')->count() }} video</span>
                <span class="chip">{{ $materials->whereNotNull('pdf')->count() }} PDF</span>
            </div>

            <section class="table-card">
                <div class="table-head">
                    <h2 class="table-title">Daftar Materi</h2>
                    <span class="table-count">Terbaru di atas</span>
                </div>

                @if ($materials->isEmpty())
                    <div class="empty">Belum ada materi learning.</div>
                @else
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Materi</th>
                                    <th>Kategori</th>
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
                                            <div class="material">
                                                <span class="number">{{ $loop->iteration }}</span>
                                                <p class="material-title">{{ $material->title }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="category-pill">{{ $material->kategori }}</span>
                                        </td>
                                        <td class="description">{{ $material->description ?: '-' }}</td>
                                        <td>
                                            @if ($material->video)
                                                <a class="file-link" href="{{ asset('storage/' . $material->video) }}" target="_blank">Video</a>
                                            @else
                                                <span class="muted">Kosong</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($material->pdf)
                                                <a class="file-link pdf" href="{{ asset('storage/' . $material->pdf) }}" target="_blank">PDF</a>
                                            @else
                                                <span class="muted">Kosong</span>
                                            @endif
                                        </td>
                                        <td>{{ $material->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="actions">
                                                <a class="button secondary" href="{{ route('learning.materials.edit', $material->id) }}">Edit</a>
                                                <form action="{{ route('learning.materials.destroy', $material->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
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
