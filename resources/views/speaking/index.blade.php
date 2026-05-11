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

        body {
            margin: 0;
            background: #eef2f3;
            color: #17211f;
            font-family: Inter, Arial, sans-serif;
        }

        a {
            color: inherit;
        }

        .content {
            width: min(1120px, calc(100% - 32px));
            margin: 30px auto;
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
            color: #5c6f69;
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
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .button.secondary {
            background: #2f6055;
        }

        .button.danger {
            background: #c24135;
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
            border: 1px solid #d7dedb;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 18px 40px rgba(31, 41, 55, 0.08);
        }

        .table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 18px;
            border-bottom: 1px solid #dfe7e3;
        }

        .table-title {
            margin: 0;
            font-size: 18px;
        }

        .table-count {
            color: #62746f;
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
            color: #62746f;
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
            color: #2f6055;
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
            color: #62746f;
            font-weight: 800;
        }

        @media (max-width: 860px) {
            .content {
                margin: 22px auto;
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
    <main class="content">
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
</body>
</html>
