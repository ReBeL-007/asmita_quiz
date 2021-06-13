@extends('site.master')
@section('title','Pricing')
@section('styles')
<style>
        @media screen and (max-width:768px) {
            #footer {
                margin-top: 0;
            }
            .pricing-img {
                width: 100%;
            }
            .pricing-img img {
                object-fit: cover;
                margin-bottom: 200px;
                margin-left: -30px;
            }
            .single-price {
                border-left: none;
            }
            .price-2 {
                margin-left: 0;
                border-right: none;
                width: 100%;
            }
            .single-price h3 {
                margin-left: 40px;
            }
            .single-price {
                border-bottom: 2px solid #D2DAE2;
                margin-left: 8px;
            }
            .pricing-img {
                visibility: hidden;
                display: none;
            }
            .register-now a {
                font-weight: bold;
                font-size: 12px;
                text-align: center;
                color: #FFFEFE;
            }
        }
        
        @media screen and (max-width:425px) {
            .pricing-img {
                /* visibility: hidden; */
                display: none;
            }
            /* #footer {
                margin-top: 300px;
            } */
            /* .pricing-img img {
                object-fit: cover;
                margin-bottom: 200px;
                margin-left: -30px;
            } */
            .single-price {
                border-left: none;
            }
            .price-2 {
                margin-top: 40px;
                border-right: none;
                width: 100%;
            }
            .single-price {
                border-bottom: 2px solid #D2DAE2;
                margin-left: 8px;
                margin-top: 30px;
            }
            .single-price h3 {
                font-size: 20px;
            }
            .single-price span {
                font-size: 20px;
            }
            .register-now {
                margin-bottom: 10px;
                /* padding-right: 20px; */
               
            }
            .register-now a {
                font-weight: bold;
                font-size: 15px;
                text-align: center;
                color: #FFFEFE;
                padding-right: 10px;               
            }
        }
    </style>
@endsection
@section('content')
<section id="pricing-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div id="title">
                        <h1>Pricing</h1>
                        <hr class="rounded-title" style="margin-left: 35%;">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-price">
                        <h5>CMAT</h5>
                        <p class="up">60 Total hours <span>60% OFF</span></p>
                        <h3>Rs. 5,000 </h3><span>Rs. 2,000</span>
                        <p class="down">This package includes preparation courses for Mathematics, English, and General Knowledge</p>
                        <div class="register-now">
                            <a data-toggle="modal" data-target="#exampleModal" class=" btn">Register Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-price price-2">
                        <h5>KUUMAT</h5>
                        <p class="up">60 Total hours <span>60% OFF</span></p>
                        <h3>Rs. 5,000 </h3> <span>Rs. 2,000</span>
                        <p class="down">This package includes preparation courses for Mathematics, English, and General Knowledge</p>
                        <div class="register-now">
                            <a data-toggle="modal" data-target="#exampleModal" class=" btn">Register Now</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="pricing-img" >
                <img src="{{ asset('frontend/img/Pricing.svg')}}" alt="" style="width:100%; object-fit: cover; ">
            </div>
        </div>

    </section>
@endsection