<main>
    <div class="container-fluid">
        <div class="form-floating">
            <form action="/save/notes/{{ $kode }}" method="POST">
                @csrf
                <textarea name="notes_for_decline" class="form-control border" placeholder="Ketik Notes disini" id="floatingTextarea"></textarea>
                <button type="submit" class=" mt-2 btn btn-success"> Simpan</button>
            </form>
        </div>
    </div>
</main>
