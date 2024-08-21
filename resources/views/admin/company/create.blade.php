@extends('admin.layouts.app')

@section('title')
    Produk
@endsection

@section('content')
  <div class="col-span-12 my-6">
    <div class="flex justify-between items-center">
        <h2 class="text-lg font-medium truncate">Tambah Data Produk</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('product.index')}}" class="button w-36 mb-2 flex items-center justify-center bg-gray-700 text-white"> <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Kembali </a>
        </div>
    </div>
  </div>
  <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <form action="{{ route('product.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
      @csrf
      
      <div class="grid grid-cols-12 gap-5">
          <div class="col-span-6">
              <div>
                  <label>Nama Produk</label>
                  <input type="text" id="input-produk" name="nama_produk" class="input w-full border mt-2" placeholder="Masukkan nama produk" value="" >
              </div>
          </div>
          <div class="col-span-6">
            <div>
                <label>Slug</label>
                <input type="text" id="slug" readonly name="slug" class="input w-full border mt-2" placeholder="Slug Produk" value="" >
            </div>
        </div>
          <div class="col-span-6">
            <div>
                <label>Kategori Produk</label>
                <select class="input w-full border mt-2" name="category_id">
                  <option disabled selected>Pilih Kategori</option>
                  @foreach ($kategori as $data)
                  <option value="{{ $data->id }}">{{ ucfirst($data->name) }}</option>
                  @endforeach
                </select> 
            </div>
          </div>
          <div class="col-span-6">
            <div>
                <label>Harga Produk</label>
                <input type="number" name="price" class="input w-full border mt-2" placeholder="Masukkan harga" value="" >
            </div>
          </div>
          <div class="col-span-12">
            <div>
              <label for="">Keywords</label>
              <input type="text" id="tag-input" class="input w-full border mt-2" placeholder="Tambahkan Keywords">
              <input type="hidden" value="" id="tag-value" name="keyword">
              <div id="tag-input-container" class="flex flex-wrap gap-1 mt-2"></div>
            </div>
          </div>
          <div class="col-span-12">
            <div>
                <label>Status Tampil</label>
                <select class="input w-full border mt-2" name="status">
                  <option disabled selected>Pilih Status Tampil</option>
                  <option value="aktif">Aktif</option>
                  <option value="tidak aktif">Tidak Aktif</option>
                </select> 
            </div>
          </div>
          <div class="col-span-12">
            <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              <h3 class="px-5 pt-5 font-bold text-lg">Data Variant</h3>
              <div class="p-5" id="wrapper-variant">
                <div class="grid grid-cols-12 gap-5" id="body-variant">
                    <div class="col-span-4">
                      <div>
                          <label>Variant Produk</label>
                          <input type="text" name="nama_variant[]" class="input w-full border mt-2" placeholder="Masukkan variant produk" value="" >
                      </div>
                    </div>
                    <div class="col-span-2">
                      <div>
                          <label>Stok Produk</label>
                          <input type="number" name="stok[]" class="input w-full border mt-2" placeholder="Stok" value="" >
                      </div>
                    </div>
                    <div class="col-span-5">
                      <div>
                          <label>Gambar Produk</label>
                          <input type="file" name="img[]" class="input w-full border mt-1" placeholder="Masukkan stok produk" value="" >
                      </div>
                    </div>
                    <div class="col-span-1">
                      <div>
                        <button href="" id="btn-add-row" type="button" class="button w-36 mb-2 mr-2 flex h-10 items-center justify-center bg-theme-1 text-white" style="margin-top: 2em" > <i class="fa fa-plus" style="width: 20px" aria-hidden="true"></i></button>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-span-12">
            <div>
                <label>Deskripsi Produk</label>
                <textarea type="text" name="deskripsi" rows="5" class="input w-full border mt-2" placeholder="Masukkan deskripsi produk" value="" ></textarea>
            </div>
          </div>
          <div class="col-span-12 flex justify-end" >
            <button type="submit" class="button w-36 mb-2 flex items-center justify-center bg-theme-1 text-white"> Simpan </button>
          </div>
      </div>
    </form>
  </div>
@endsection

@section('js-content')
    <script>
      $(document).ready(function(){
        $('#btn-add-row').on('click',function(){
          addVariant();
        })
        
        $('#input-produk').on('keyup',function(){
          $('#slug').val(createSlug($(this).val()))
        })
      })

      function createSlug(input) {
        return input.toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-');
      }

      function addVariant(){
        var row = `
          <div class="grid grid-cols-12 gap-5 mt-3" id="body-variant">
              <div class="col-span-4">
                <div>
                    <label>Variant Produk</label>
                    <input type="text" name="nama_variant[]" class="input w-full border mt-2" placeholder="Masukkan variant produk" value="" >
                </div>
              </div>
              <div class="col-span-2">
                <div>
                    <label>Stok Produk</label>
                    <input type="number" name="stok[]" class="input w-full border mt-2" placeholder="Stok" value="" >
                </div>
              </div>
              <div class="col-span-5">
                <div>
                    <label>Gambar Produk</label>
                    <input type="file" name="img[]" class="input w-full border mt-1" placeholder="Masukkan stok produk" value="" >
                </div>
              </div>
              <div class="col-span-1">
                <div>
                  <button type="button" class="button w-36 mb-2 mr-2 flex h-10 items-center justify-center bg-red-700 text-white btn-hapus-row" style="margin-top: 2em" ><i class="fa fa-trash-o" style="width: 20px" aria-hidden="true"></i></button>
                </div>
              </div>
          </div>
        `
        $('#wrapper-variant').append(row)
        $('#wrapper-variant').on('click','.btn-hapus-row',function(){
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
          class: 'bg-blue-500 text-white rounded px-2 py-1 flex items-center mr-2 mb-2',
        });

        const tagText = $('<span>', {
          text: tag,
        });

        const removeButton = $('<button>', {
          class: 'ml-2 focus:outline-none',
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
        tagInputContainer.find('.bg-blue-500 span').each(function() {
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
@endsection
