<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Speaking Materials</title>
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
            width: min(1120px, calc(100% - 32px));
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

        .subtitle {
            margin: 6px 0 0;
            color: #64748b;
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

        .button.danger {
            background: #dc2626;
        }

        .alert {
            margin-bottom: 16px;
            padding: 12px 14px;
            border-radius: 6px;
            background: #dcfce7;
            color: #166534;
            font-weight: 700;
        }

        .table-wrap {
            overflow-x: auto;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 860px;
        }

        th,
        td {
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f8fafc;
            color: #334155;
            font-size: 13px;
            text-transform: uppercase;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .description {
            max-width: 320px;
            color: #475569;
            line-height: 1.5;
        }

        .file-link {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
        }

        .muted {
            color: #94a3b8;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .empty {
            padding: 28px;
            text-align: center;
            color: #64748b;
        }
    </style>
</head>
<body>
    <main class="page">
        <div class="header">
            <div>
                <h1>Speaking Materials</h1>
                <p class="subtitle">Kelola materi speaking, video, dan PDF.</p>
            </div>

            <a class="button" href="{{ route('speaking.materials.create') }}">Tambah Materi</a>
        </div>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="table-wrap">
            @if ($materials->isEmpty())
                <div class="empty">Belum ada materi speaking.</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
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
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $material->title }}</strong></td>
                                <td class="description">{{ $material->description ?: '-' }}</td>
                                <td>
                                    @if ($material->video)
                                        <a class="file-link" href="{{ asset('storage/' . $material->video) }}" target="_blank">Lihat Video</a>
                                    @else
                                        <span class="muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($material->pdf)
                                        <a class="file-link" href="{{ asset('storage/' . $material->pdf) }}" target="_blank">Lihat PDF</a>
                                    @else
                                        <span class="muted">Tidak ada</span>
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
            @endif
        </div>
    </main>
</body>
</html>
