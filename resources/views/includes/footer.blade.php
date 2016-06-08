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



<!-- ====================== Page screen ======================== -->

<!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>TNM Clinical Stage Grouping</h4>
      <p>โปรดเลือกข้อมูล <span class="blue-text text-darken-2">Primary Tumor(T)</span>, <span class="red-text text-darken-2">regional Lymph Nodes(N)</span>, <span class="teal-text text-darken-2">Distant Metastasis(M)</span> </p>

      <form>
        <ul class="collection">
          <li class="collection-item">
            <input name="tumor" type="radio" id="tumor1" value="1" />
            <label for="tumor1"><span class="blue-text text-darken-2">TX</span> <span class="grey-text">Primary tumor cannot be assessed</span></label>
          </li>
          <li class="collection-item">
            <input name="tumor" type="radio" id="tumor2" value="2" />
            <label for="tumor2"><span class="blue-text text-darken-2">T0</span> <span class="grey-text">No evidence of primary tumor</span></label>
          </li>
          <li class="collection-item">
            <input name="tumor" type="radio" id="tumor3" value="3" />
            <label for="tumor3"><span class="blue-text text-darken-2">Tis</span> <span class="grey-text">Carcinoma in situ</span></label>
          </li>
          <li class="collection-item">
            <input name="tumor" type="radio" id="tumor4" value="4" />
            <label for="tumor4"><span class="blue-text text-darken-2">T1</span> <span class="grey-text">Tumor 2 cm or less in greatest dimension</span></label>
          </li>
          <li class="collection-item">
            <input name="tumor" type="radio" id="tumor5" value="5" />
            <label for="tumor5"><span class="blue-text text-darken-2">T2</span> <span class="grey-text">Tumor more than 2 cm but not more than 4 cm in greatest dimension</span></label>
          </li>
          <li class="collection-item"> 
            <input name="tumor" type="radio" id="tumor6" value="6" />
            <label for="tumor6"><span class="blue-text text-darken-2">T3</span> <span class="grey-text">Tumor more than 4 cm in greatest dimension</span></label>
          </li>
          <li class="collection-item">
            <input name="tumor" type="radio" id="tumor7" value="7" />
            <label for="tumor7"><span class="blue-text text-darken-2">T4(lip)</span> <span class="grey-text">Tumor invades adjacent structres</span></label>
          </li>
          <li class="collection-item">
            <input name="tumor" type="radio" id="tumor8" value="8" />
            <label for="tumor8"><span class="blue-text text-darken-2">T4(oral cavity)</span> <span class="grey-text">Tumor invades adjacent structres</span></label>
          </li>
        </ul>

        <!-- ============================================== -->

        <ul class="collection">
          <li class="collection-item">
            <input name="nodes" type="radio" id="nodes1" value="1" />
            <label for="nodes1"><span class="red-text text-darken-2">NX</span> <span class="grey-text">Regional Lymph nodes cannot be assessed</span></label>
          </li>
          <li class="collection-item">
            <input name="nodes" type="radio" id="nodes2" value="2" />
            <label for="nodes2"><span class="red-text text-darken-2">N0</span> <span class="grey-text">No Regional Lymph nodes metastasis</span></label>
          </li>
          <li class="collection-item">
            <input name="nodes" type="radio" id="nodes3" value="3" />
            <label for="nodes3"><span class="red-text text-darken-2">N1</span> <span class="grey-text">Metastasis in a single ipsilateral lymph node, 3 cm or less in greater dimension</span></label>
          </li>
          <li class="collection-item">
            <input name="nodes" type="radio" id="nodes4" value="4" />
            <label for="nodes4"><span class="red-text text-darken-2">N2</span> 
              <span class="grey-text">
                  Metastasis in a single ipsilateral lymph node, more than 3 cm but not more than 6 cm in greater dimension;
                  in multiple ipsilatral limph nodes, none more than 6 cm in greater dimension;in bilateral or contralateral lymph nodes, 
                  none more than 6 cm in greater dimension
              </span>
            </label>
          </li>
          <li class="collection-item">
            <input name="nodes" type="radio" id="nodes5" value="5" />
            <label for="nodes5"><span class="red-text text-darken-2">N2a</span> <span class="grey-text">Metastasis in single ipsilateral lymph node more 3 cm or but not more than 6 cm in greater dimension</span></label>
          </li>
          <li class="collection-item">
            <input name="nodes" type="radio" id="nodes6" value="6" />
            <label for="nodes6"><span class="red-text text-darken-2">N2b</span> <span class="grey-text">Metastasis in multiple ipsilateral lymph node, none more than 6 cm in greater dimension</span></label>
          </li>
          <li class="collection-item">
            <input name="nodes" type="radio" id="nodes7" value="7" />
            <label for="nodes7"><span class="red-text text-darken-2">N2c</span> <span class="grey-text">Metastasis in bilateral or contralateral lymph node, none more than 6 cm in greater dimension</span></label>
          </li>
          <li class="collection-item">
            <input name="nodes" type="radio" id="nodes8" value="8" />
            <label for="nodes8"><span class="red-text text-darken-2">N3</span> <span class="grey-text">Metastasis in lymph node more than 6 cm in greater dimension</span></label>
          </li>
        </ul>

        <!-- ============================================== -->

        <ul class="collection">
          <li class="collection-item">
            <input name="met" type="radio" id="met1" value="1" />
            <label for="met1"><span class="teal-text text-darken-2">MX</span> <span class="grey-text">Presence of distant metastasis cannot be assessed</span></label>
          </li>
          <li class="collection-item">
            <input name="met" type="radio" id="met2" value="2" />
            <label for="met2"><span class="teal-text text-darken-2">M0</span> <span class="grey-text">No distant metastasis</span></label>
          </li>
          <li class="collection-item">
            <input name="met" type="radio" id="met3" value="3" />
            <label for="met3"><span class="teal-text text-darken-2">M1</span> <span class="grey-text">Distant metastasis</span></label>
          </li>
        </ul>

      </form>

    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-red btn-flat " id="modalClose" href="#!">ยกเลิก</a>
      <a class="modal-action modal-close waves-effect waves-green btn-flat " id="modalSave" href="#!">บันทึก</a>
    </div>
  </div>









