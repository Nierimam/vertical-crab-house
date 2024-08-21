@extends('user.layouts.app')

@section('content')
<!-- Ec Blog page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-blogs-rightside col-lg-12 col-md-12">

                <!-- Blog content Start -->
                <div class="ec-blogs-content">
                    <div class="ec-blogs-inner">
                        <div class="ec-blog-main-img d-flex justify-content-center">
                            <img class="blog-image" src="{{ asset('upload/'.$blog->blog_medias[0]->media) }}" width="400px" alt="Blog" />
                        </div><br>
                        <div class="ec-blog-date">
                            <p class="date">{{ date('d M Y', strtotime($blog->created_at)) }} - Admin</p>
                        </div>
                        <div class="ec-blog-detail">
                            <h3 class="ec-blog-title">{{ $blog->judul }}</h3>
                            <div style="text-align: justify">
                                {{ $blog->deskripsi }}
                            </div>
                            <div class="ec-blog-sub-imgs">
                                <div class="row">
                                    @foreach($blog->blog_medias as $key => $value)
                                      @if($key > 0)
                                        <div class="col-md-6">
                                            <img class="blog-image" src="{{ asset('upload/'.$value->media) }}" alt="Blog" />
                                        </div>
                                      @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Blog content End -->
            </div>
        </div>
    </div>
</section>
@endsection
