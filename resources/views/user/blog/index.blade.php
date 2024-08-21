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
                        <div class="row">
                            @if (count($blogs) > 0)
                            @foreach($blogs as $blog)
                                @if($blog->status == 'publish')
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-6 ec-blog-block" style="box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);">
                                        <div class="ec-blog-inner" style="padding: 10px">
                                            <div class="ec-blog-image mb-4 text-center">
                                                <a href="{{ route('blog-detail',$blog->id) }}">
                                                    <img class="blog-image" src="{{ 'upload/'.$blog->blog_medias[0]->media }}" width="400px"
                                                        alt="Blog" />
                                                </a>
                                            </div>
                                            <div class="ec-blog-content">
                                                <h5 class="ec-blog-title"><a
                                                        href="{{ route('blog-detail',$blog->id) }}">{{ $blog->judul }}</a></h5>

                                                <div class="ec-blog-date">By <span>Admin</span> / {{ date('d M Y', strtotime($blog->created_at)) }}</div>
                                                <div class="ec-blog-desc mb-3">
                                                    @if (strlen($blog->deskripsi) > 100)
                                                        {{ substr($blog->deskripsi, 0, 100) }}...
                                                    @else
                                                        {{ $blog->deskripsi }}
                                                    @endif
                                                </div>
                                                <div class="ec-blog-btn"><a href="{{ route('blog-detail',$blog->id) }}" class="btn btn-primary">Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @else
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="card">
                                        <div class="card-body" style="padding-top: 5rem;padding-bottom:5rem">
                                            <div class="text-center">
                                                <h1 style="color: #cc2514">Tidak Ada Data Blog</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!--Blog content End -->
            </div>
        </div>
    </div>
</section>
@endsection
