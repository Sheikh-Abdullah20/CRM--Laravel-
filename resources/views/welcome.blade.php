@extends('layouts.guest')

@section('title')
CRM - Home
@endsection


@section('css')

<style>


.hero-container{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.child-container{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
    img {
        background-blend-mode: multiply;
        border-radius: 20px
    }


* { color:#fff; text-decoration: none;}

 .span{
    font-size: clamp(0.5rem,5vw,2rem);
    color: white;
 }


.blink{	
		line-height: 50px;
	}
	h4{
		color: white;
		animation: blink 2s linear infinite;
	}
        @keyframes blink{
        0%{opacity: 0;}
        50%{opacity: .5;}
        100%{opacity: 1;}
        }

    @media (max-width: 576px) {
        .hero-container {
            text-align: center;
            flex-direction: column;
        }
    } 
.li::marker{
    content: '🔰'
}

    
</style>

@endsection

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between hero-container">
        <div class="col-md-6 d-flex flex-column justify-content-center">
           
                <span  class="typewrite span" data-period="2000" data-type='["Manage Your Customer Relationships Like Never Before😎","Your All-in-One CRM for Streamlined Business Success🤗","Boost Sales and Build Stronger Connections with Powerful CRM Tools😃"]'></span>
                <h4 class="blink">Build stronger relationships with <span class="text-warning">ease</span> </h4>
          
        </div>
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <img src="{{ asset('assets/img/Home Hero Image.jpg') }}" alt="">
        </div>
    </div>


    <div class="row child-container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center"><span class="text-success">Why Choose Our CRM?</span> Explore the Essential Features </h3>
                    <div class="d-flex justify-content-between">
                        <div class="col-md-6">
                            <ul>
                                <li class="mb-4 li">
                                    <b>All-in-One CRM Functionality:</b> Our platform encompasses all essential CRM features, including contact management, lead tracking, sales forecasting, and reporting. This ensures that you have a holistic view of your customer interactions and sales pipeline.</li>

                                <li class="mb-4 li">
                                   <b> Integrated Reminder System:</b> Never miss an important deadline again! Our built-in reminder system helps you stay on top of follow-ups, appointments, and critical tasks, ensuring that you can provide timely responses to your clients.
                                </li>

                                <li class="mb-4 li">
                                    <b>Advanced Scheduler:</b> Plan your day efficiently with our intuitive scheduling tool. You can easily manage your calendar, set up meetings, and allocate time for important tasks, all within the CRM interface.
                                </li>

                                <li class="mb-4 li">
                                    <b>User-Friendly Interface:</b> Designed with ease of use in mind, our CRM features a clean and intuitive interface that allows you to navigate seamlessly between different functionalities.
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-md-6">
                            <ul>
                                <li class="mb-5 li">
                                    <b>Customizable Dashboards:</b> Tailor your dashboard to display the metrics that matter most to you. Get real-time insights into your sales performance, customer interactions, and more.
                                </li>

                                <li class="mb-5 li">
                                   <b> Collaboration Tools:</b> Enhance teamwork with features that allow you to share notes, assign tasks, and collaborate on projects, making it easier for your team to work together.
                                </li>

                                <li class="mb-5 li">
                                    <b>Mobile Access:</b> Stay connected on the go! Our mobile-friendly design lets you access your CRM from anywhere, ensuring you can manage customer relationships no matter where you are.
                                </li>

                                <li class="mb-5 li">

                                    <b>Robust Security Features:</b> We prioritize your data security with advanced encryption and user permissions, giving you peace of mind that your information is safe.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   


        
        <div class="row child-container">
            <div class="col-md-12">
                <h1 class="text-center">Contact Us</h1>
                <form action="{{ route('guest.queries') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" name="name" id="Name">
                        @error('name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="Email">Email</label>
                        <input type="text" class="form-control" name="email" id="Email">
                        @error('email')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control" name="description" id="description"></textarea>
                        @error('description')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
            </div>
        </div>

</div>
@endsection

@section('scripts')
<script>
    var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
        this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
        this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) { delta /= 2; }

        if (!this.isDeleting && this.txt === fullTxt) {
        delta = this.period;
        this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
        this.isDeleting = false;
        this.loopNum++;
        delta = 500;
        }

        setTimeout(function() {
        that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i=0; i<elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
              new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    }
    
</script>
@endsection

