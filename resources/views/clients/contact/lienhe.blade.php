@extends('layouts.client')




@section('content')
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">contact us</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- google map start -->
 
    <!-- google map end -->

    <!-- contact area start -->
    <div class="contact-area section-padding pt-0 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-message">
                        <h4 class="contact-title">Tell Us Your Project</h4>
                        <form action="{{route('guilienhe')}}" method="post" class="contact-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input  placeholder="Name *" type="text" required  name="ho_va_ten">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input placeholder="Phone *" type="text" required  name="so_dien_thoai">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input  placeholder="Email *" type="text" required name="email">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input  placeholder="Subject *" type="text" name="chu_de">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input  placeholder="Images *" type="file" name="images">
                                </div>
                                <div class="col-12">
                                    <div class="contact2-textarea text-center">
                                        <textarea placeholder="Message *" class="form-control2"  name="message"></textarea>
                                    </div>
                                    <div class="contact-btn">
                                        <button class="btn btn-sqr" type="submit">Send Message</button>

                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <p class="form-messege"></p>
                                </div>
                            </div>
                        </form>
                        
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-info">
                        <h4 class="contact-title">Contact Us</h4>
                        <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum
                            est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum
                            formas human.</p>
                        <ul>
                            <li><i class="fa fa-fax"></i> Địa chỉ : <a href="#">Cửu Yên - Ngũ Thái - Thuận Thành - Bắc ninh</a></li>
                            <li><i class="fa fa-envelope-o"></i>Email: <a href="#"> quanndph41110@fpt.edu.vn</a></li>
                            <li><i class="fa fa-phone"></i> <a href="">+8483183446</a></li>
                        </ul>
                        <div class="working-time">
                            <h6>Working Hours</h6>
                            <p><span>Monday – Saturday:</span>08AM – 22PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact area end -->
</main>

@endsection