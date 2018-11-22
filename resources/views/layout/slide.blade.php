<div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">

                    	<?php $i=0; ?>
                    	@foreach($slide as $sl)
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" 
							@if($i ==0)
                       			 class="active"
                       		 @endif
                       ></li>
                        <?php $i++; ?>
                        @endforeach
                    </ol>

                    <div class="carousel-inner">
                    	<?php $i=0; ?>
                        <div
                        @if($i==0)
                        	 class="item active"
                        @else
                        	class="item"
                        @endif>
                        <?php $i++; ?>
                            <img class="slide-image" src="image/anh-ab/ht3.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="slide-image" src="image/anh-ab/banner1.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="slide-image" src="image/anh-ab/ht2.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="slide-image" src="image/anh-ab/ht1.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="slide-image" src="image/anh-ab/ab4.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="slide-image" src="image/anh-ab/baner.jpg" alt="">
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>