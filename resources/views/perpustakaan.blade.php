<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>PWEB Week 12</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Tailwind CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-br from-purple-600 to-blue-500 text-gray-800 font-sans py-10 px-4">

    <div class="max-w-5xl mx-auto">
        <h1 class="text-4xl text-white font-bold text-center mb-10">Query Builder dan ORM</h1>

        {{-- Card Component --}}
        <div class="space-y-6">

            {{-- 1.1 SELECT Dasar --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4 text-purple-700">1.1 SELECT Dasar</h2>
                <ul>
                    @foreach ($books as $book)
                        <li>Judul Buku : {{ $book->title }}</li>
                        <li>Tahun Buku : {{ $book->year }}</li>
                    @endforeach
                </ul>
                <br>
                <p>Judul Buku Pertama : {{ $firstBook->title }}</p>
                <br>
                <p>Judul Buku Pertama Lagi : {{ $firstTitle }}</p>
                <br>
                <ul>
                    @foreach ($titlesOnly as $title)
                        <li>Judul Buku : {{ $title }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- 1.2 WHERE Clause dan Filter --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4 text-purple-700">1.2 WHERE Clause dan Filter</h2>
                <ul>
                    @foreach ($tersedia as $book)
                        <li>Judul Buku Tersedia : {{ $book->title }}</li>
                    @endforeach
                </ul>
                <br>
                <ul>
                    @foreach ($orWhere as $book)
                        <li>Judul Buku OrWhere : {{ $book->title }}</li>
                    @endforeach
                </ul>
                <br>
                <ul>
                    @foreach ($between as $book)
                        <li>Judul Buku Between : {{ $book->title }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- 1.3 INSERT --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4 text-purple-700">1.3 INSERT Buku Baru</h2>
                <form action="{{ route('books.insert') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="title" placeholder="Judul Buku" class="w-full p-2 border rounded"
                        required>
                    <input type="number" name="year" placeholder="Tahun Terbit" class="w-full p-2 border rounded"
                        required>
                    <select name="status" class="w-full p-2 border rounded" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Dipinjam">Dipinjam</option>
                    </select>
                    <select name="author_id" class="w-full p-2 border rounded" required>
                        <option value="" disabled selected>Pilih Penulis</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Tambah
                        Buku</button>
                </form>
            </div>

            {{-- 1.4 UPDATE --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4 text-purple-700">1.4 UPDATE</h2>
                <form action="{{ route('books.update') }}" method="POST" class="space-y-4 max-w-md">
                    @csrf
                    <select name="book_id" required class="w-full p-2 border rounded">
                        <option value="" disabled selected>Pilih Buku untuk Update</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="title_update" placeholder="Judul Baru" class="w-full p-2 border rounded"
                        required />
                    <input type="number" name="year_update" placeholder="Tahun Baru" class="w-full p-2 border rounded"
                        required />
                    <input type="text" name="status_update" placeholder="Status Baru"
                        class="w-full p-2 border rounded" required />
                    <button type="submit"
                        class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition">Update
                        Buku</button>
                </form>
            </div>

            {{-- 1.5 DELETE --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4 text-purple-700">1.5 DELETE Buku</h2>
                <form action="{{ route('books.delete') }}" method="POST" class="space-y-4">
                    @csrf
                    <select name="book_id" class="w-full p-2 border rounded" required>
                        <option value="" disabled selected>Pilih Buku</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->title }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus
                        Buku</button>
                </form>
            </div>


            {{-- 1.6 JOIN --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4 text-purple-700">1.6 JOIN antar Tabel</h2>
                <ul>
                    @foreach ($booksWithAuthor as $book)
                        <li>Buku {{ $book->title }} ditulis oleh {{ $book->author }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- 1.7 SORT & PAGINATION --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4 text-purple-700">1.7 Sorting & Pagination</h2>
                <ul>
                    @foreach ($sorted as $sort)
                        <li>Judul Buku Terurut : {{ $sort->title }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- 1.8 AGGREGATE --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4 text-purple-700">1.8 Aggregate Query</h2>
                <p>Total Buku : {{ $total }}</p>
                <p>Jumlah Tahun : {{ $sum }}</p>
                <p>Rata - rata Tahun : {{ $avg }}</p>
                <p>Tahun Maximum : {{ $max }}</p>
                <p>Tahun Minimum : {{ $min }}</p>
            </div>

        </div>
    </div>

</body>

</html>

<script>
    document.querySelector('select[name="book_id"]').addEventListener('change', function() {
        const bookId = this.value;
        if (!bookId) return;

        fetch(`/books/${bookId}`)
            .then(response => {
                if (!response.ok) throw new Error('Data buku tidak ditemukan');
                return response.json();
            })
            .then(data => {
                document.querySelector('input[name="title_update"]').value = data.title || '';
                document.querySelector('input[name="year_update"]').value = data.year || '';
                document.querySelector('input[name="status_update"]').value = data.status || '';
            })
            .catch(error => {
                alert(error.message);
                document.querySelector('input[name="title_update"]').value = '';
                document.querySelector('input[name="year_update"]').value = '';
                document.querySelector('input[name="status_update"]').value = '';
            });
    });
</script>
