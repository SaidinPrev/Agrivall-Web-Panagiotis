<label class="form-label fw-semibold" for="tipo_post_id">Tipo</label>
<select class="form-select mb-3" id="tipo_post_id" name="tipo_post_id" required>
    @foreach ($tipos as $tipo)
        <option value="{{ $tipo->id }}" @selected(old('tipo_post_id', $post->tipo_post_id) == $tipo->id)>
            {{ $tipo->tipo }}
        </option>
    @endforeach
</select>

<label class="form-label fw-semibold" for="titulo">Título</label>
<input class="form-control mb-3" id="titulo" name="titulo" value="{{ old('titulo', $post->titulo) }}" required>

<label class="form-label fw-semibold" for="imagen">Ruta de imagen</label>
<input class="form-control mb-3" id="imagen" name="imagen" value="{{ old('imagen', $post->imagen) }}"
    placeholder="imgs/cherries.jpg">

<label class="form-label fw-semibold" for="noticia">Noticia</label>
<textarea class="form-control mb-4" id="noticia" name="noticia" rows="8" required>{{ old('noticia', $post->noticia) }}</textarea>
