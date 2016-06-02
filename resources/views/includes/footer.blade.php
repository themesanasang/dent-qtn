 <footer class="page-footer">
      <div class="container">
        <div class="row">
          <div class="col l4 s12">
            <h5 class="white-text">ระบบคัดกรองความเสี่ยงโรคมะเร็งช่องปาก</h5>
            <p class="grey-text text-lighten-4">
                คุณสามารถลงข้อมูลการคัดกรองความเสี่ยงโรคมะเร็งช่องปาก ในระบบได้ตามส่วนที่กำหนด
                ระบบจะเก็บข้อมูลเพื่อไปช่วยในการประมวนผลต่อไป
                (ระบบแสดงผลได้ทุกขนาดหน้าจอ, ใช้งานได้ดีบน Google-Chrome และ Firefox และ IE 10+)
            </p>
          </div>

          <div class="col l4 s12" style="overflow: hidden;">
              <h5 class="white-text">ไฟล์ติดตั้ง DT-SCREEN</h5>
              <a class="btn waves-effect waves-light red lighten-3" href="{{ url('downloads/app') }}">โหลด App DT-SCREEN</a>
          </div>
          
          <div class="col l4 s12">
            <h5 class="white-text">เมนู</h5>
            <ul>
              <li><a class="grey-text text-lighten-3" href="{!! url('screen') !!}">คัดกรอง</a></li>   
              <li><a class="grey-text text-lighten-3" href="{!! url('screen.list') !!}">รายการคัดกรอง</a></li>    
               @if( Session::get('status') == '1' ) 
                  <li><a class="grey-text text-lighten-3" href="{!! url('reports') !!}">รายงาน</a></li>
                  <li><a class="grey-text text-lighten-3" href="{!! url('user') !!}">จัดการผู้ใช้</a></li> 
               @endif
               <li><a class="grey-text text-lighten-3" href="{!! url('user') !!}/editprofile/{{ Crypt::encrypt(Session::get('uid')) }}">ข้อมูลส่วนตัว</a></li>
            </ul>
          </div>

        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
            © 2015 ThemeSanasang, All rights reserved.     
        </div>
      </div>
</footer>