@extends('admin.layouts.app')

@section('title')
    Produk
@endsection

@section('content')
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-lg font-medium truncate">Edit Data Produk</h2>
            <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
                <a href="{{ route('product.index') }}" class="btn btn-secondary"> Kembali </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('product.update', $data->id) }}" method="POST" autocomplete="off"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" required id="input-produk" name="nama_produk"
                                class="form-control form-control-sm" placeholder="Masukkan nama produk"
                                value="{{ ucfirst($data->nama_produk) }}">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Slug</label>
                            <input type="text" required id="slug" readonly name="slug"
                                class="form-control form-control-sm" placeholder="Slug Produk" value="{{ $data->slug }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Kategori Produk</label>
                            <select class="form-control form-control-sm" name="category_id" required>
                                @foreach ($kategori as $kategoris)
                                    <option value="{{ $kategoris->id }}" @if ($kategoris->id == $data->category_id) selected @endif>
                                        {{ ucfirst($kategoris->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="" class="form-label">Keywords</label>
                            <input type="text" id="tag-input" class="form-control form-control-sm"
                                placeholder="Tambahkan Keywords">
                            <input type="hidden" required value="{{ $data->keyword }}" id="tag-value" name="keyword">
                            <div id="tag-input-container" class="flex flex-wrap gap-1 mt-2"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Status Tampil</label>
                            <select class="form-control form-control-sm" name="status" required>
                                @foreach (statusInfo()['status_tampil_produk'] as $key => $value)
                                    <option value="{{ $key }}" {{ $key == $data->status ? 'selected' : '' }}>
                                        {{ $value['label'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="font-bold text-lg">Data Variant</h3>
                            <div id="body-gambar" class="col-lg-12">
                                @php
                                    $gambar_blog = '';
                                    $stok_variant = '';
                                    $price_variant = '';
                                    $berat_variant = '';
                                @endphp
                                @foreach ($variant as $key => $value)
                                    @php
                                        if ($stok_variant != '') {
                                            $stok_variant .= ',';
                                        }
                                        $stok_variant .= $value->id;

                                        if ($price_variant != '') {
                                            $price_variant .= ',';
                                        }
                                        $price_variant .= $value->id;

                                        if ($berat_variant != '') {
                                            $berat_variant .= ',';
                                        }
                                        $berat_variant .= $value->id;

                                        if ($gambar_blog != '') {
                                            $gambar_blog .= ',';
                                        }
                                        $gambar_blog .= $key + 1;
                                        $showDelete = false;
                                        if ($key > 0) {
                                            $showDelete = true;
                                        }
                                    @endphp
                                    <div id="pembungkus-{{ $key + 1 }}" class="mb-3 card">
                                        <div id="wrapper-variant" class="card-body">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label class="form-label">Variant Produk</label>
                                                        <input type="hidden" required name="variant_id[]"
                                                            class="input w-full border mt-2"
                                                            placeholder="Masukkan variant produk"
                                                            value="{{ ucfirst($value->id) }}">
                                                        <input type="text" required name="nama_variant_update[]"
                                                            class="form-control form-control-sm"
                                                            placeholder="Masukkan variant produk"
                                                            value="{{ ucfirst($value->nama_variant) }}">
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <label class="form-label">Stok Produk</label>
                                                        <input type="text" required name="stok_update[]"
                                                            class="form-control form-control-sm input-stok-variant"
                                                            placeholder="Stok" data-id="{{ $value->id }}"
                                                            value="{{ $value->stok }}">
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <label class="form-label">Harga</label>
                                                        <input type="text" required name="price_update[]"
                                                            class="form-control form-control-sm input-price-variant"
                                                            data-id="{{ $value->id }}" placeholder="Harga"
                                                            value="{{ $value->price }}">
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <label class="form-label">Berat (gram)</label>
                                                        <input type="text" required name="berat_update[]"
                                                            class="form-control form-control-sm input-berat-variant"
                                                            data-id="{{ $value->id }}" placeholder="Berat"
                                                            value="{{ $value->berat }}">
                                                    </div>

                                                    <div class="col-lg-2">
                                                        <label class="form-label">Gambar</label>
                                                        <input type="file" name="img_update[]"
                                                            class="form-control form-control-sm input-file-gambar"
                                                            data-id="{{ $value->id }}" value="" multiple>
                                                        <div class="mt-1">
                                                            <a class="input-group-text fancybox btn btn-sm btn-primary"
                                                                id="basic-addon2" data-caption="{{ $data->nama_produk }}"
                                                                href="{{ asset('upload/' . $value->img) }}">Lihat
                                                                Gambar</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-1">
                                                        @if ($showDelete)
                                                            <div>
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm btn-hapus-row"
                                                                    data-key="{{ $key + 1 }}"
                                                                    data-id="{{ $value->id }}"
                                                                    style="margin-top: 2em">
                                                                    <i class="fa fa-trash-o" style="width: 20px"
                                                                        aria-hidden="true"></i></button>
                                                            </div>
                                                        @else
                                                            <div>
                                                                <button href="" id="btn-add-row" type="button"
                                                                    class="btn btn-success btn-sm"
                                                                    style="margin-top: 2em"><i class="fa fa-plus"
                                                                        style="width: 20px"
                                                                        aria-hidden="true"></i></button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <input type="hidden" id="stok_variant" value="{{ $stok_variant }}"
                                    name="stok_variant_edit">
                                <input type="hidden" id="stok_variant_delete" name="stok_variant_delete"
                                    value="">
                                <input type="hidden" id="stok_variant_edit" value="">

                                <input type="hidden" id="price_variant" value="{{ $price_variant }}"
                                    name="price_variant_edit">
                                <input type="hidden" id="price_variant_delete" name="price_variant_delete"
                                    value="">
                                <input type="hidden" id="price_variant_edit" value="">

                                <input type="hidden" id="berat_variant" value="{{ $berat_variant }}"
                                    name="berat_variant_edit">
                                <input type="hidden" id="berat_variant_delete" name="berat_variant_delete"
                                    value="">
                                <input type="hidden" id="berat_variant_edit" value="">

                                <input type="hidden" id="gambar_blog" value="{{ $gambar_blog }}">
                                <input type="hidden" id="gambar_blog_delete" name="gambar_blog_delete" value="">
                                <input type="hidden" id="gambar_blog_edit" name="gambar_blog_edit" value="">
                            </div>

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Deskripsi Produk</label>
                            <textarea type="text" equired name="deskripsi" rows="5" class="form-control form-control-sm"
                                placeholder="Masukkan deskripsi produk" value="">{{ $data->deskripsi }}</textarea>
                        </div>
                    </div>
                    <div class="col-span-12 d-flex justify-content-end">
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
            $('#input-produk').on('keyup', function() {
                $('#slug').val(createSlug($(this).val()))
            })
        })

        function createSlug(input) {
            return input.toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-');
        }
        $(document).ready(function() {
            var gambar_blogs = $('#gambar_blog').val().split(',');
            var stok_variant = $('#stok_variant').val().split(',');

            $('#btn-add-row').click(function() {
                addRow()
            });

            // Set Price Variant
            $('.input-price-variant').on('keyup', function(e) {
                var price_variant_edit = $('#price_variant_edit').val();
                if (price_variant_edit != '') {
                    price_variant_edit += ',';
                }
                price_variant_edit += $(this).data('id')
                $('#price_variant_edit').val(price_variant_edit)
            })

            // Set Berat Variant
            $('.input-berat-variant').on('keyup', function(e) {
                var berat_variant_edit = $('#berat_variant_edit').val();
                if (berat_variant_edit != '') {
                    berat_variant_edit += ',';
                }
                berat_variant_edit += $(this).data('id')
                $('#berat_variant_edit').val(berat_variant_edit)
            })

            //   Set Stok Variant
            $('.input-stok-variant').on('keyup', function(e) {
                var stok_variant_edit = $('#stok_variant_edit').val();
                console.log(stok_variant_edit);
                if (stok_variant_edit != '') {
                    stok_variant_edit += ',';
                }
                stok_variant_edit += $(this).data('id')
                $('#stok_variant_edit').val(stok_variant_edit)
            })

            //   set Gambar
            $('.input-file-gambar').on('change', function(e) {
                var gambar_blog_edit = $('#gambar_blog_edit').val();
                if (gambar_blog_edit != "") {
                    gambar_blog_edit += ',';
                }
                gambar_blog_edit += $(this).data('id')
                $('#gambar_blog_edit').val(gambar_blog_edit);
            })

            // Hapus Baris
            $('#body-gambar').on('click', '.btn-hapus-row', function() {
                var gambar_blog_delete = $('#gambar_blog_delete').val();
                var stok_variant_delete = $('#stok_variant_delete').val();
                var price_variant_delete = $('#price_variant_delete').val();
                var berat_variant_delete = $('#berat_variant_delete').val();

                if (price_variant_delete != "") {
                    price_variant_delete += ',';
                }
                price_variant_delete += $(this).data('id')
                $('#price_variant_delete').val(price_variant_delete);

                if (berat_variant_delete != "") {
                    berat_variant_delete += ',';
                }
                berat_variant_delete += $(this).data('id')
                $('#berat_variant_delete').val(berat_variant_delete);

                if (stok_variant_delete != "") {
                    stok_variant_delete += ',';
                }
                stok_variant_delete += $(this).data('id')
                $('#stok_variant_delete').val(stok_variant_delete);

                if (gambar_blog_delete != "") {
                    gambar_blog_delete += ',';
                }
                gambar_blog_delete += $(this).data('id')
                $('#gambar_blog_delete').val(gambar_blog_delete);
                $('#pembungkus-' + $(this).data('key')).remove();
            });
        });

        function addRow() {
            var jumlah = $('input[type="file"]');
            var newRow = `
      <div id="pembungkus-${jumlah.length + 1}" class="card">
        <div class="card-body">
          <div class="col-lg-12" >
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
                    <input type="text" required name="price[]"
                        class="form-control form-control-sm" placeholder="Harga" value="">
                </div>

                <div class="col-lg-2">
                    <label class="form-label">Berat (gram)</label>
                    <input type="text" required name="berat[]"
                        class="form-control form-control-sm" placeholder="Berat" value="">
                </div>
                <div class="col-lg-2">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="img[]" class="form-control form-control-sm" value="" multiple required>
                </div>
                <div class="col-lg-1">
                    <button data-key="${jumlah.length + 1}" type="button" class="btn btn-sm btn-danger btn-hapus-row-new" style="margin-top: 2em" ><i class="fa fa-trash-o" style="width: 20px" aria-hidden="true"></i></button>
                </div>
            </div>

          </div>
        </div>
    </div>
      `
            $('#body-gambar').append(newRow);
            $('#body-gambar').on('click', '.btn-hapus-row-new', function() {
                var gambar_blog_delete = $('#gambar_blog_delete').val();
                var stok_variant_delete = $('#stok_variant_delete').val();

                if (stok_variant_delete != "") {
                    stok_variant_delete += ',';
                }
                $('#stok_variant_delete').val(gambar_blog_delete);

                if (gambar_blog_delete != "") {
                    gambar_blog_delete += ',';
                }
                gambar_blog_delete += $(this).data('id')
                $('#gambar_blog_delete').val(gambar_blog_delete);
                $('#pembungkus-' + $(this).data('key')).remove();
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            const tagInputContainer = $('#tag-input-container');
            const tagInput = $('#tag-input');
            const tagValue = $('#tag-value');
            var keyword = '{{ $data->keyword }}'
            $.each(keyword.split(','), function(key, val) {
                addTag(val)
            })

            function addTag(tag) {
                const tagElement = $('<div>', {
                    class: 'badge bg-info me-2',
                });

                const tagText = $('<span>', {
                    text: tag,
                });

                const removeButton = $('<button>', {
                    class: 'ml-2 btn focus:outline-none',
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
