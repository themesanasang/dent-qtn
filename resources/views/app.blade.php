<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    @include('includes.head')
</head>
<body>
    <div class="wrapper">
      
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>    
        
    <div class="navbar-fixed">
        <nav>             
            <div class="nav-wrapper">	
            <div class="col s12"> 
                              
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-action-view-headline"></i></a>    
                                                  
                <ul class="right hide-on-med-and-down">                    
                  <li><a href="{!! url('screen') !!}"><i class="mdi-action-visibility left"></i> คัดกรอง</a></li>  
                  <li><a href="{!! url('screen.list') !!}"><i class="mdi-action-list left"></i> รายการคัดกรอง</a></li>
                  <li><a href="#!"><i class="mdi-action-description left"></i> รายงาน</a></li>
                   @if( Session::get('status') == '1' )
                      <li><a href="{!! url('user') !!}"><i class="mdi-action-settings-applications left"></i> จัดการผู้ใช้</a></li> 
                      <li class="divider"></li> 
                   @endif
                    <li><a href="{!! url('user') !!}/editprofile/{{ Crypt::encrypt(Session::get('uid')) }}"><i class="mdi-action-perm-identity left"></i> {!! Session::get('username') !!}</a></li>              
                    <li><a href="#" id="searchtoggl"><i class="mdi-action-search left"></i>ค้นหา</a></li>  
                  <li><a href="{{ url('logout') }}"><i class="mdi-action-lock-open left"></i> ออกระบบ</a></li>               
                </ul>  
                                                                   
            </div>
            </div><!-- .nav-wrapper -->
            
            <!-- side-nav Menu -->
            <ul class="side-nav" id="mobile-demo">
                  <li><a href="{!! url('screen') !!}"><i class="mdi-action-visibility left"></i> คัดกรอง</a></li> 
                  <li><a href="{!! url('screen.list') !!}"><i class="mdi-action-list left"></i> รายการคัดกรอง</a></li>     
                  <li><a href="#!"><i class="mdi-action-description left"></i> รายงาน</a></li>
                  <li><a href="{!! url('user') !!}/editprofile/{{ Crypt::encrypt(Session::get('uid')) }}"><i class="mdi-action-perm-identity left"></i> ข้อมูลส่วนตัว</a></li>
                  <li class="divider"></li>
                   @if( Session::get('status') == '1' )
                      <li><a href="{!! url('user') !!}"><i class="mdi-action-settings-applications left"></i> จัดการผู้ใช้</a></li> 
                      <li class="divider"></li> 
                   @endif
                  <li><a href="{{ url('logout') }}"><i class="mdi-action-lock-open left"></i> ออกระบบ</a></li>
            </ul>
            
            <div class="container">
            <div id="searchbar" class="clearfix z-depth-1">
               {!! Form::open( array('url' => 'screen.search', 'id' => 'searchform') ) !!}    
                <button type="submit" id="searchsubmit"></button>
                <input type="search" name="s" id="s" placeholder="ค้นหารายการ CID, ชื่อ-สกุล" autocomplete="off">
               {!! Form::close() !!}
            </div>
            </div>
        </nav>
    </div>  
    
    <div id="wrapper-content" class="wrapper-content">  
        <div class="container content">    
            
            @yield('content')
           
        </div>
    </div>  
        
      
    <!-- Confirm save data -->    
    <div class="c-confirm">
    <div class="cd-popup" role="alert">
        <div class="cd-popup-container">
            <p>คุณต้องการบันทึกข้อมูลคัดกรองหรือไม่?</p>
            <ul class="cd-buttons">
                <li><a class="c-ok" href="#">บันทึก</a></li>
                <li><a class="c-no" href="#0">ไม่</a></li>
            </ul>
            <a href="#0" class="cd-popup-close img-replace">Close</a>
        </div> <!-- cd-popup-container -->
    </div> <!-- cd-popup -->
    </div>       
                                 
    </div><!-- .wrapper -->
    
    @include('includes.footer')

	<!-- Scripts -->
	@include('includes.script')
    
</body>
</html>
