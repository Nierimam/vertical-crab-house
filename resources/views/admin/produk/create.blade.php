@extends('admin.layouts.app')

@section('title')
    Produk
@endsection

@section('content')
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-lg font-medium truncate">Tambah Data Produk</h2>
            <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
                <a href="{{ route('product.index') }}" class="btn btn-secondary"> Kembali </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" required id="input-produk" name="nama_produk"
                                class="form-control form-control-sm" placeholder="Masukkan nama produk" value="">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Slug</label>
                            <input type="text" required id="slug" readonly name="slug"
                                class="form-control form-control-sm" placeholder="Slug Produk" value="">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Kategori Produk</label>
                            <select class="form-control form-control-sm" name="category_id" required>
                                <option disabled selected value="">Pilih Kategori</option>
                                @foreach ($kategori as $data)
                                    <option value="{{ $data->id }}">{{ ucfirst($data->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label" for="">Keywords</label>
                            <input type="text" id="tag-input" class="form-control form-control-sm"
                                placeholder="Tambahkan Keywords">
                            <input type="hidden" value="" id="tag-value" name="keyword">
                            <div id="tag-input-container" class="flex flex-wrap gap-1 mt-2"></div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Status Tampil</label>
                            <select class="form-control form-control-sm" name="status" required>
                                <option disabled selected value="">Pilih Status Tampil</option>
                                <option value="publish">Publish</option>
                                <option value="non_publish">Tidak Publish</option>
                            </select>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="text-lg">Data Variant</h3>
                            <div id="wrapper-variant">
                                <div class="col-lg-12 mb-3" id="body-variant">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="form-label">Variant Produk</label>
                                            <input type="text" required name="nama_variant[]"
                                                class="form-control form-control-sm" placeholder="Variant"
                                                value="">
                                        </div>

                                        <div class="col-lg-2">
                                            <label class="form-label">Stok Produk</label>
                                            <input type="number" required name="stok[]"
                                                class="form-control form-control-sm" placeholder="Stok" value="">
                                        </div>

                                        <div class="col-lg-2">
                                            <label class="form-label">Harga</label>
                                            <input type="text" required name="price[]"
                                                class="form-control form-control-sm" placeholder="Harga" value="">
                                        </div>

                                        <div class="col-lg-2">
                                            <label class="form-label">Berat (gram)</label>
                                            <input type="text" required name="berat[]"
                                                class="form-control form-control-sm" placeholder="Berat" value="">
                                        </div>

                                        <div class="col-lg-2">
                                            <label class="form-label">Gambar Produk</label>
                                            <input type="file" required name="img[]"
                                                class="form-control form-control-sm" placeholder="Masukkan stok produk"
                                                value="">
                                        </div>

                                        <div class="col-lg-1">
                                            <button href="" id="btn-add-row" type="button"
                                                class="btn btn-sm btn-success" style="margin-top: 2em"> <i
                                                    class="fa fa-plus" style="width: 20px"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Deskripsi Produk</label>
                            <textarea type="text" required name="deskripsi" rows="5" class="form-control form-control-sm"
                                placeholder="Masukkan deskripsi produk" value=""></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success"> Simpan </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js-content')
    <script>
        $(document).ready(function() {
            $('#btn-add-row').on('click', function() {
                addVariant();
            })

            $('#input-produk').on('keyup', function() {
                $('#slug').val(createSlug($(this).val()))
            })
        })

        function createSlug(input) {
            return input.toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-');
        }

        function addVariant() {
            var row = `
          <div class="col-lg-12 mb-3" id="body-variant">
              <div class="row">
                <div class="col-lg-3">
                    <label class="form-label">Variant Produk</label>
                    <input type="text" required name="nama_variant[]" class="form-control form-control-sm" placeholder="Masukkan variant produk" value="" >
                </div>
                <div class="col-lg-2">
                    <label class="form-label">Stok Produk</label>
                    <input type="number" required name="stok[]" class="form-control form-control-sm" placeholder="Stok" value="" >
                </div>
                <div class="col-lg-2">
                    <label class="form-label">Harga</label>
                    <input type="number" required name="price[]"
                        class="form-control form-control-sm" placeholder="Harga" value="">
                </div>

                <div class="col-lg-2">
                    <label class="form-label">Berat</label>
                    <input type="number" required name="berat[]"
                        class="form-control form-control-sm" placeholder="Berat" value="">
                </div>
                <div class="col-lg-2">
                    <label class="form-label">Gambar Produk</label>
                    <input type="file" required name="img[]" class="form-control form-control-sm" placeholder="Masukkan stok produk" value="" >
                </div>
                <div class="col-lg-1">
                  <button type="button" class="btn btn-sm btn-danger btn-hapus-row" style="margin-top: 2em" ><i class="fa fa-trash-o" style="width: 20px" aria-hidden="true"></i></button>
                </div>
              </div>
          </div>
        `
            $('#wrapper-variant').append(row)
            $('#wrapper-variant').on('click', '.btn-hapus-row', function() {
                $(this).closest('#body-variant').remove();
            })
        }
    </script>

    <script>
        $(document).ready(function() {
            const tagInputContainer = $('#tag-input-container');
            const tagInput = $('#tag-input');
            const tagValue = $('#tag-value');

            function addTag(tag) {
                const tagElement = $('<div>', {
                    class: 'badge bg-info me-2',
                });

                const tagText = $('<span>', {
                    text: tag,
                });

                const removeButton = $('<button>', {
                    class: 'ms-2 btn focus:outline-none',
                    html: '&times;',
                    click: function() {
                        tagElement.remove();
                        updateTagValue();
                    },
                });

                tagElement.append(tagText, removeButton);
                tagInputContainer.append(tagElement);
                updateTagValue();
            }

            function updateTagValue() {
                const tags = [];
                tagInputContainer.find('.badge span').each(function() {
                    tags.push($(this).text());
                });
                tagValue.val(tags.join(','));
            }

            tagInput.on('input', function() {
                const inputValue = tagInput.val().trim();
                tagValue.val(inputValue);
            });

            tagInput.on('keypress', function(event) {
                if (event.which === 13) {
                    event.preventDefault();
                    handleTagInput();
                }
            });

            function handleTagInput() {
                const inputValue = tagInput.val().trim();

                if (inputValue !== '') {
                    addTag(inputValue);
                    tagInput.val('');
                }
            }
        });
    </script>

    @if (session('error'))
        <script>
            $(document).ready(function() {
                Swal.fire(
                    'Gagal!',
                    '{{ session('error') }}',
                    'warning'
                );
            });
        </script>
    @endif
@endsection
