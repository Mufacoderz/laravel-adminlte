@include('admin.layouts.meta')
@include('admin.layouts.header')
@include('admin.layouts.sidebar')

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Dashboard v2</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard v2</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Berita</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('berita.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="">Nama Kategori</label>
                                        <select name="kategori_id" id="form-control">
                                            @foreach ($kategori as $item )
                                            <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label >Judul Berita</label>
                                        <input type="text" name="judul_berita" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label >Isi Berita</label>
                                        <textarea name="isi_berita" class="form-control"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label>Gambar</label>
                                        <input type="file" name="gambar" id="gambars" class="form-control">
                                    </div>

                                    <img id="preview" width="350" class="mt-4">

                                    <button class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
@include('admin.layouts.footer')
@include('admin.layouts.js')
