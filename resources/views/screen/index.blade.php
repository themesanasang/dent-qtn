@extends('app')

@section('content')

    <div class="row">
        <div class="col s12"> 
                               
            <div class="row">
                <h2 class="col s12 header center">แบบสอบถามเพื่อคัดกรองความเสี่ยงโรคมะเร็งช่องปาก</h2>
            </div>
            
            <div class="center-tab">
            <div class="row">
            <div class="col s12 ">
              <ul class="tabs content-tab">
                <li class="tab-top tab col s3"><a href="#tab1">ส่วนที่ 1</a></li>
                <li class="tab-top tab col s3"><a href="#tab2">ส่วนที่ 2</a></li>
                <li class="tab-top tab col s3"><a href="#tab3">ส่วนที่ 3</a></li>
                 
                 @if( Session::get('status') == '1' || Session::get('status') == '2' ) 
                    <li class="tab-top tab col s3"><a href="#tab4">ส่วนที่ 4</a></li>
                 @endif 

                 <li class="tab-top tab col s3"><a href="#tab5">ข้อมูลอื่น ๆ</a></li> 
              </ul>
            </div>
            </div>
            </div>
               
            
            {!! Form::open( array('route' => 'screen.store', 'class' => 'form-horizontal', 'id' => 'screenform', 'files'=>true) ) !!}
            
            <!-- ============== Part 1 =============== -->
            <!-- ============== Part 1 =============== -->
            <!-- ============== Part 1 =============== -->
            <div id="tab1" class="row">
            <h4 class="header part center">ส่วนที่ 1 ข้อมูลทั่วไป</h4>
            <div class="form-body">
                <div class="row">
                    <div class="input-field col s12">
                      <input id="fullname" name="fullname" type="text">                      
                      <label id="er-fullname" for="fullname">1.ชื่อ-สกุล</label>                          
                    </div>                                                         
                </div><!-- fullname -->  
                
                <div class="row">                                             
                    <div class="input-field col s12">
                      <input id="cid" name="cid" type="text">
                      <label id="er-cid" for="cid">2.เลขบัตรประชาชน</label>
                    </div>              
                </div><!-- cid -->   
                
                <div class="row">
                    <div class="input-field col s12">
                      <input id="age" name="age" type="text">
                      <label id="er-age" for="age">3.อายุ</label>
                    </div>              
                </div><!-- age --> 
                        
                <div class="row">
                     <div class="input-field col s12">                     
                     <label>4.เพศ:</label>
                         <br />
                      <p>      
                          <div class="col m2 s12">  
                              <input name="sex" type="radio" id="sex1" value="1" />
                              <label for="sex1">1.ชาย</label>
                          </div>
                          <div class="col m2 s12">
                              <input name="sex" type="radio" id="sex2" value="2" />
                              <label for="sex2">2.หญิง</label>
                         </div>
                      </p>                         
                    </div>                                       
                </div><!-- sex --> 
                        
                <div class="row">
                   <div class="input-field col s12">                     
                     <label>5.สถานภาพสมรส:</label>
                     <br />
                      <p>      
                          <div class="col m3 s12">
                              <input name="status" type="radio" id="status1" value="1" />
                              <label for="status1">1.โสด</label>
                          </div>
                         <div class="col m3 s12">
                              <input name="status" type="radio" id="status2" value="2" />
                              <label for="status2">2.สมรส</label>
                          </div>
                          <div class="col m3 s12">
                              <input name="status" type="radio" id="status3" value="3" />
                              <label for="status3">3.หย่าร้าง</label>
                          </div>
                         <div class="col m3 s12">
                          <input name="status" type="radio" id="status4" value="4" />
                          <label for="status4">4.หม้าย</label>
                         </div>
                      </p>                         
                    </div>
                </div><!-- status --> 
                        
                <div class="row">
                    <div class="input-field col s12">                     
                     <label>6.ระดับการศึกษา:</label>
                     <br />
                      <p>
                          <div class="col m5 s12">
                              <input name="school" type="radio" id="school1" value="1" />
                              <label for="school1">1.ประถม</label>   
                          </div>  
                          <div class="col m7 s12">
                              <input name="school" type="radio" id="school2" value="2"  />
                              <label for="school2">2.มัธยม / ปวช</label>   
                          </div> 

                          <div class="col m5 s12">
                              <input name="school" type="radio" id="school3" value="3"  />
                              <label for="school3">3.ปวท / ปวส</label>   
                          </div>  
                          <div class="col m7 s12">
                              <input name="school" type="radio" id="school4" value="4"  />
                              <label for="school4">4.ปริญญาตรี</label>   
                          </div>  

                          <div class="col m5 s12">
                              <input name="school" type="radio" id="school5" value="5"  />
                              <label for="school5">5.สูงกว่าปริญญาตรี</label>   
                          </div>  
                          <div class="col m7 s12">                           
                              <input name="school" type="radio" id="school6"  value="6" />
                              <label for="school6">6.อื่น ๆ ระบุ</label>                                               
                          </div>
                      </p>
                    </div>
                </div><!-- school --> 
                <div class="row">                  
                    <div class="input-field col s12">
                          <input placeholder="โปรดระบุ" id="textschool" name="textschool" type="text">     
                    </div>         
                </div><!-- textschool -->  
                        
                <div class="row">
                    <div class="input-field col s12">                     
                     <label>7.อาชีพ:</label>
                     <br />
                     <p>    
                          <div class="col m5 s12">
                              <input name="work" type="radio" id="work1" value="1" />
                              <label for="work1">1.เกษตรกร</label>   
                          </div>  
                          <div class="col m7 s12">
                              <input name="work" type="radio" id="work2"  value="2" />
                              <label for="work2">2.รับจ้าง</label>   
                          </div> 

                          <div class="col m5 s12">
                              <input name="work" type="radio" id="work3" value="3"  />
                              <label for="work3">3.พนักงานบริษัท</label>   
                          </div>  
                          <div class="col m7 s12">
                              <input name="work" type="radio" id="work4" value="4"  />
                              <label for="work4">4.ค้าขาย / ธุรกิจส่วนตัว</label>   
                          </div>  

                          <div class="col m5 s12">
                              <input name="work" type="radio" id="work5" value="5"  />
                              <label for="work5">5.พนักงานราชการ / ราชการ</label>   
                          </div>  
                          <div class="col m7 s12">                           
                              <input name="work" type="radio" id="work6" value="6"  />
                              <label for="work6">6.อื่น ๆ ระบุ</label>                                               
                          </div> 
                      </p>
                    </div>
                </div><!-- work --> 
                <div class="row">                    
                    <div class="input-field col s12">
                          <input placeholder="โปรดระบุ" id="textwork" name="textwork" type="text">     
                    </div>         
                </div><!-- textwork -->  
                
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="textarea1" class="materialize-textarea" name="address"></textarea>
                        <label for="textarea1">8.ที่อยู่</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col l4 s12">
                        <label id="er-chwpart">จังหวัด:</label>
                        {!! Form::select('chwpart', [null=>'กรุณาเลือก'] + $province, null, ['id' => 'chwpart', 'class' => 'browser-default']) !!}
                    </div>
                    <div class="col l4 s12"> 
                       <label id="er-amppart">อำเภอ:</label>
                       <select name="amppart" id="amppart" class="browser-default">
                           <option value="" disabled selected>กรุณาเลือก</option>                                        
                       </select>                       
                    </div>
                    <div class="col l4 s12">
                        <label id="er-tmbpart">ตำบล:</label>
                       <select name="tmbpart" id="tmbpart" class="browser-default">
                            <option value="" disabled selected>กรุณาเลือก</option>                          
                       </select>                       
                    </div>
                </div> <!-- address --> 
                
                <div class="row">
                    <div class="input-field col l6 s12">
                      <input name="tel" id="tel" type="text">
                      <label for="tel">9.โทรศัพท์</label>
                    </div>
                    <div class="input-field col l6 s12">
                      <input name="mobile" id="mobile" type="text">
                      <label for="mobile">มือถือ</label>
                    </div>
                </div> <!-- ติดต่อ -->                 
                                        
            </div><!-- .form-body 1 -->
            </div>
            

            <!-- ============== Part 2 =============== -->
            <!-- ============== Part 2 =============== -->
            <!-- ============== Part 2 =============== -->
            <div id="tab2" class="row">
            <h4 class="header part center">ส่วนที่ 2 ปัจจัยเสี่ยงมะเร็งช่องปาก</h4>
            <div class="form-body">
                
                <div class="row">
                     <div class="input-field">    
                        <label>10.ปัจจุบันท่านสูบบุหรี่หรือไม่:</label>
                     </div>
                    <div class="col s12">                    
                     <br /><br />
                     <p>    
                          <div class="col s12">
                              <input name="smoking" type="radio" id="smoking1" value="1" />
                              <label for="smoking1">1.ไม่สูบ</label>   
                          </div>                          
                          <div class="col s12">
                              <input name="smoking" type="radio" id="smoking2" value="2"  />
                              <label for="smoking2">2.สูบ</label>   
                          </div>  
                          <div class="input-field col l6 s12">                              
                              <input name="smokingday" id="smokingday" type="text">   
                              <label for="smokingday">ท่านสูบบุหรี่วันละ กี่มวน</label>
                          </div>
                          <div class="input-field col l6 s12">                                
                              <input name="smokinglong" id="smokinglong" type="text">  
                              <label for="smokinglong">สูบบุหรี่มานาน กี่ปี</label>
                          </div> 

                          <div class="col s12">
                              <input name="smoking" type="radio" id="smoking3" value="3"  />
                              <label for="smoking3">3.เคยสูบ( แต่เลิกแล้ว )</label>   
                          </div>  
                          <div class="input-field col s12">    
                                <input name="smokingstop" id="smokingstop" type="text">   
                                <label for="smokingstop">ท่านเลิกสูบบุหรี่มานาน กี่ปี</label>
                          </div> 
                      </p>
                    </div>
                </div><!-- smoking --> 
            
                <div class="row">
                     <div class="input-field col s12">                     
                     <label>11.มีบุคคลที่พักอาศัยในบ้านสูบบุหรี่หรือไม่:</label>
                     <br />
                      <p>     
                          <div class="col m2 s12"> 
                              <input name="hassmoking" type="radio" id="hassmoking1" value="1" />
                              <label for="hassmoking1">1.มี</label>
                          </div>
                          <div class="col m2 s12">
                              <input name="hassmoking" type="radio" id="hassmoking2" value="2" />
                              <label for="hassmoking2">2.ไม่มี</label>
                          </div>
                      </p>                         
                    </div>                                       
                </div><!-- hassmoking --> 

                 <div class="row">
                     <div class="input-field">    
                        <label>12.ปัจจุบันท่านใช้ยานัตถุ์ / ยาเส้นหรือไม่:</label>
                     </div>
                    <div class="col s12">                       
                     <br /><br />
                     <p>    
                          <div class="col s12">
                              <input name="hasnus" type="radio" id="hasnus1" value="1" />
                              <label for="hasnus1">1.ไม่ใช้</label>   
                          </div>                          
                          <div class="col s12">
                              <input name="hasnus" type="radio" id="hasnus2" value="2"  />
                              <label for="hasnus2">2.ใช้</label>   
                          </div>  
                          <div class="input-field col s12">                              
                              <input name="nuslong" id="nuslong" type="text">   
                              <label for="nuslong">ใช้ยานัต์ / ยาเส้นมานาน กี่ปี</label>
                          </div> 
                          <div class="col s12">
                              <input name="hasnus" type="radio" id="hasnus3" value="3"  />
                              <label for="hasnus3">3.เคยใช้( แต่เลิกแล้ว )</label>   
                          </div>  
                          <div class="input-field col s12">    
                                <input name="nusstop" id="nusstop" type="text"> 
                                <label for="nusstop">เลิกใช้ยานัต์ / ยาเส้นมานาน กี่ปี</label>
                          </div> 
                      </p>
                    </div>
                </div><!-- hasnus -->

                <div class="row">
                    <div class="input-field">    
                        <label>13.ปัจจุบันท่านเคี้ยวหมากหรือไม่:</label>
                     </div>
                    <div class="col s12">                       
                     <br /><br />
                     <p>    
                          <div class="col s12">
                              <input name="hasareca" type="radio" id="hasareca1" value="1" />
                              <label for="hasareca1">1.ไม่เคี้ยว</label>   
                          </div>                          
                          <div class="col s12">
                              <input name="hasareca" type="radio" id="hasareca2" value="2"  />
                              <label for="hasareca2">2.เคี้ยว</label>   
                          </div>  
                          <div class="input-field col s12">                              
                              <input name="arecalong" id="arecalong" type="text">   
                              <label for="arecalong">เคี้ยวหมากมานาน กี่ปี</label>
                          </div> 
                          <div class="col s12">
                              <input name="hasareca" type="radio" id="hasareca3" value="3"  />
                              <label for="hasareca3">3.เคยเคี้ยว( แต่เลิกแล้ว )</label>   
                          </div>  
                          <div class="input-field col s12">    
                                <input name="arecastop" id="arecastop" type="text">    
                                <label for="arecastop">เลิกเคี้ยวหมากมานาน กี่ปี</label> 
                          </div> 
                      </p>
                    </div>
                </div><!-- hasareca -->

                <div class="row">
                    <div class="input-field">    
                        <label>14.ปัจจุบันท่านดืมเครื่องดืมผสมแอลกอฮอล์หรือไม่:</label>
                     </div>
                    <div class="col s12">                       
                     <br /><br />
                     <p>    
                          <div class="col s12">
                              <input name="alcohol" type="radio" id="alcohol1" value="1" />
                              <label for="alcohol1">1.ไม่ดื่ม</label>   
                          </div>                          
                          <div class="col s12">
                              <input name="alcohol" type="radio" id="alcohol2"  value="2" />
                              <label for="alcohol2">2.ดื่ม</label>   
                          </div>
                        
                         <div id="alcohol_child">
                          <div class="col s12">
                            <div class="leftup">  
                                <div class="input-field">    
                                    <label>ท่านเครื่องดื่มชนิดใด:</label>
                                 </div>
                                <br />
                                <p>
                                      <div class="col s12">
                                          <input name="drinktype" type="radio" id="drinktype1" value="1" checked  />
                                          <label for="drinktype1">1.เหล้าขาว</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="drinktype" type="radio" id="drinktype2" value="2"  />
                                          <label for="drinktype2">2.เหล้าสี</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="drinktype" type="radio" id="drinktype3" value="3"  />
                                          <label for="drinktype3">3.เบียร์</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="drinktype" type="radio" id="drinktype4" value="4"  />
                                          <label for="drinktype4">4.ไวน์</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="drinktype" type="radio" id="drinktype5" value="5"  />
                                          <label for="drinktype5">5.อื่น ๆ ระบุ</label>   
                                      </div>
                                      <div class="input-field col s12">                                        
                                          <input name="drinktypetext" id="drinktypetext" type="text">
                                          <label for="drinktypetext">โปรดระบุ</label> 
                                      </div> 
                                </p>
                           </div>
                         </div>    
                         <div class="col s12">
                            <div class="leftup">  
                                <div class="input-field">    
                                    <label>ท่านดื่มวันละ:</label>
                                 </div>
                                <br />
                                <p>
                                      <div class="input-field col s12">                                        
                                          <input name="drinkunittext" id="drinkunittext" type="text">
                                          <label for="drinkunittext">โปรดระบุ</label> 
                                      </div> 
                                      <div class="col s12">
                                          <input name="drinkunit" type="radio" id="drinkunit1" value="1" checked  />
                                          <label for="drinkunit1">1.เป๊ก</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="drinkunit" type="radio" id="drinkunit2" value="2"  />
                                          <label for="drinkunit2">2.กั๊ก</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="drinkunit" type="radio" id="drinkunit3" value="3"  />
                                          <label for="drinkunit3">3.แบน</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="drinkunit" type="radio" id="drinkunit4" value="4"  />
                                          <label for="drinkunit4">4.กระป๋อง</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="drinkunit" type="radio" id="drinkunit5" value="5"  />
                                          <label for="drinkunit5">5.ขวดเล็ก</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="drinkunit" type="radio" id="drinkunit6" value="6"  />
                                          <label for="drinkunit6">6.ขวดใหญ่</label>   
                                      </div>
                                </p>
                           </div>
                         </div> 
                        <div class="input-field col s12">  
                             <div class="leftup-alcohollong">
                                <input name="alcohollong" id="alcohollong" type="text">  
                                 <label for="alcohollong">ดื่มมานาน กี่ปี</label>
                            </div>
                        </div> 
                        </div>
                        
                          <div class="col s12">
                              <input name="alcohol" type="radio" id="alcohol3" value="3" />
                              <label for="alcohol3">3.เคยดื่ม( แต่เลิกแล้ว )</label>   
                          </div>  
                          <div class="input-field col s12">    
                                <input name="alcoholstop" id="alcoholstop" type="text"> 
                                <label for="alcoholstop">เลิกดื่มมานาน กี่ปี</label> 
                          </div> 
                      </p>
                    </div>
                </div><!-- alcohol -->

               <div class="row">
                     <div class="row">  
                        <div class="input-field">
                        <label>15.ประวัติการป่วยด้วยโรคมะเร็งของบุคคลในครอบครัว (มารดา/บิดา/พี่น้องร่วมบิดามารดา):</label>
                        </div>
                     </div>
                    <div class="show-on-small">
                        <br />
                    </div> 
                    <div class="row">
                    <div class="col s12">
                     <br />
                      <p>     
                          <div class="col s12"> 
                              <input name="hascancer" type="radio" id="hascancer1" value="1" />
                              <label for="hascancer1">1.ไม่มี</label>
                          </div>
                          <div class="col s12">
                              <input name="hascancer" type="radio" id="hascancer2" value="2" />
                              <label for="hascancer2">2.มี</label>
                          </div>
                          <div class="col s12">
                            <div class="leftup">  
                                <div class="input-field">    
                                    <label>เป็นมะเร็งชนิดใด:</label>
                                 </div>
                                <br />
                                <p>
                                      <div class="col s12">
                                          <input name="cancer" type="radio" id="cancer1" value="1" checked  />
                                          <label for="cancer1">1.มะเร็งช่องปาก</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="cancer" type="radio" id="cancer2" value="2"  />
                                          <label for="cancer2">2.มะเร็งโพรงจมูกและคอ</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="cancer" type="radio" id="cancer3" value="3"  />
                                          <label for="cancer3">3.มะเร็งปอด</label>   
                                      </div>                                     
                                      <div class="col s12">
                                          <input name="cancer" type="radio" id="cancer4" value="4"  />
                                          <label for="cancer4">4.อื่น ๆ ระบุ</label>   
                                      </div>                                 
                                      <div class="input-field col s12">                                        
                                        <input class="textcancer" name="textcancer" id="textcancer" type="text">
                                        <label class="textcancer" for="textcancer">โปรดระบุ</label>  
                                      </div> 
                                </p>
                           </div>
                         </div>    
                      </p>                         
                    </div>   
                    </div>
                </div><!-- hascancer -->

                <div class="row">
                     <div class="input-field">                     
                         <label>16.ทำงานกลางแดดเป็นประจำ:</label>
                     </div>     
                     <div class="col s12"> 
                      <br /><br />     
                      <p>     
                          <div class="col s12"> 
                              <input name="sun" type="radio" id="sun1" value="1"  />
                              <label for="sun1">1.ไม่ใช่</label>
                          </div>
                          <div class="col s12">
                              <input name="sun" type="radio" id="sun2" value="2" />
                              <label for="sun2">2.ใช่</label>
                          </div>
                          <div class="input-field col s12">                                        
                             <input class="worksun" name="worksun" id="worksun" type="text">
                             <label class="worksun" for="worksun">อยู่กลางแดดนาน กี่ชั่วโมง/วัน</label> 
                          </div> 
                      </p>                         
                    </div>                                       
                </div><!-- sun -->         
                
            </div><!-- .form-body 2 -->  
            </div>


            <!-- ============== Part 3 =============== -->
            <!-- ============== Part 3 =============== -->
            <!-- ============== Part 3 =============== -->
            <div id="tab3" class="row">
            <h4 class="header part center">ส่วนที่ 3 ผลการตรวจในช่องปาก</h4>
            <div class="form-body">
                
                <div class="row">
                     <div class="input-field col s12">                     
                     <label>17.ฟันคมทำให้ระคายเคือง:</label>
                     <br />
                      <p>      
                          <div class="col m2 s12">  
                              <input name="part3_1" type="radio" id="part3_11" value="1"  />
                              <label for="part3_11">1.มี</label>
                          </div>
                          <div class="col m3 s12">
                              <input name="part3_1" type="radio" id="part3_12" value="2" />
                              <label for="part3_12">2.ไม่มี</label>
                         </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_1 --> 

                <div class="row">
                     <div class="input-field col s12">                     
                     <label>18.ระคายเคืองจากฟันปลอม:</label>
                     <br />
                      <p>      
                          <div class="col m2 s12">  
                              <input name="part3_2" type="radio" id="part3_21" value="1"  />
                              <label for="part3_21">1.มี</label>
                          </div>
                          <div class="col m3 s12">
                              <input name="part3_2" type="radio" id="part3_22" value="2" />
                              <label for="part3_22">2.ไม่มี</label>
                         </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_2 --> 

                 <div class="row">
                     <div class="input-field col s12">                     
                     <label>19.ฟันผุที่ต้องอุด/ถอน:</label>
                     <br />
                      <p>      
                          <div class="col m2 s12">  
                              <input name="part3_3" type="radio" id="part3_31" value="1" />
                              <label for="part3_31">1.มี</label>
                          </div>
                          <div class="col m3 s12">
                              <input name="part3_3" type="radio" id="part3_32" value="2" />
                              <label for="part3_32">2.ไม่มี</label>
                         </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_3 --> 

                <div class="row">
                     <div class="input-field col s12">                     
                     <label>20.เหงือกบวม แดง มีหินปูน:</label>
                     <br />
                      <p>      
                          <div class="col m2 s12">  
                              <input name="part3_4" type="radio" id="part3_41" value="1"  />
                              <label for="part3_41">1.มี</label>
                          </div>
                          <div class="col m3 s12">
                              <input name="part3_4" type="radio" id="part3_42" value="2" />
                              <label for="part3_42">2.ไม่มี</label>
                         </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_4 --> 

                <div class="row">
                     <div class="input-field">                     
                     <label>21.ผลการตรวจเนื้อเยื่ออ่อนในช่องปาก (ริมฝีปากด้านใน-ด้านนอก, เพดานปาก, กระพุ้งแก้มซ้าย-ขวา, ลิ้น, ใต้ลิ้น):</label>
                    </div>
                     <div class="show-on-small">
                        <br /><br />
                    </div>
                    <div class="col s12">
                     <br /><br />
                      <p>     
                          <div class="col s12"> 
                              <input name="part3_5" type="radio" id="part3_51" value="1"  />
                              <label for="part3_51">1.ปกติ</label>
                          </div>
                          <div class="col s12">
                              <input name="part3_5" type="radio" id="part3_52" value="2" />
                              <label for="part3_52">2.ผิดปกติ</label>
                          </div>
                          <div class="col s12">
                            <div class="leftup">  
                                <div class="input-field">    
                                    <label>พบรอยโรค:</label>
                                 </div>
                                <br />
                                <p>
                                      <!--<div class="col s12">
                                          <input name="part3_6" type="radio" id="part3_61" value="1" checked  />
                                          <label for="part3_61">1.รอยโรคสีแดง / ขาวที่ขูดไม่ออก</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="part3_6" type="radio" id="part3_62"  value="2" />
                                          <label for="part3_62">2.แผล (Uleeration)</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="part3_6" type="radio" id="part3_63"  value="3" />
                                          <label for="part3_63">3.ก้อนหรือติ่งเนื้อ</label>   
                                      </div>  
                                      <div class="col s12">
                                          <input name="part3_6" type="radio" id="part3_65"  value="4" />
                                          <label for="part3_65">4.Submucous fibrosis</label>   
                                      </div>                                     
                                      <div class="col s12">
                                          <input name="part3_6" type="radio" id="part3_64"  value="5" />
                                          <label for="part3_64">5.รอยโรคอื่น ๆ ระบุ</label>   
                                      </div>                                 
                                      <div class="input-field col s12">                                        
                                          <input class="textpart3_6" name="textpart3_6" id="textpart3_6" type="text">
                                          <label class="textpart3_6" for="textpart3_6">โปรดระบุ</label>
                                      </div>-->

                                      <div class="col s12"> 
                                          <input type="checkbox" name="part3_61" class="filled-in" id="part3_61" value="1" />
                                          <label for="part3_61">1.รอยโรคสีแดง / ขาวที่ขูดไม่ออก</label>  
                                      </div>
                                      <div class="col s12"> 
                                          <input type="checkbox" name="part3_62" class="filled-in" id="part3_62" value="1" />
                                          <label for="part3_62">2.แผล (Uleeration)</label>  
                                      </div>
                                      <div class="col s12"> 
                                          <input type="checkbox" name="part3_63" class="filled-in" id="part3_63" value="1" />
                                          <label for="part3_63">3.ก้อนหรือติ่งเนื้อ</label>  
                                      </div>
                                      <div class="col s12"> 
                                          <input type="checkbox" name="part3_64" class="filled-in" id="part3_64" value="1" />
                                          <label for="part3_64">4.Submucous fibrosis</label>  
                                      </div>
                                      <div class="col s12"> 
                                          <input type="checkbox" name="part3_65" class="filled-in" id="part3_65" value="1" />
                                          <label for="part3_65">5.รอยโรคอื่น ๆ ระบุ</label>  
                                      </div>
                                      <div class="input-field col s12">                                        
                                          <input class="textpart3_6" name="textpart3_6" id="textpart3_6" type="text">
                                          <label class="textpart3_6" for="textpart3_6">โปรดระบุ</label>
                                      </div>

                                </p>
                           </div>
                         </div>    
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_5, 3_6 -->

                <div class="row">
                     <div class="input-field col s12">                     
                     <label>22.คลำเนื้อเยื่อรอบปากมีลักษณะคล้ายเอ็นแข็งไม่ยืดหยุ่น อ้าปากได้น้อย:</label>
                    <div class="show-on-small">
                        <br />
                    </div>
                     <br />
                      <p>      
                          <div class="col m2 s12">  
                              <input name="part3_7" type="radio" id="part3_71" value="1"  />
                              <label for="part3_71">1.มี</label>
                          </div>
                          <div class="col m3 s12">
                              <input name="part3_7" type="radio" id="part3_72" value="2" />
                              <label for="part3_72">2.ไม่มี</label>
                         </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part3_7 -->              

            </div><!-- .form-body 3 --> 
            </div>
            
            
            @if( Session::get('status') == '1' || Session::get('status') == '2' )
            <!-- ============== Part 4 =============== -->
            <!-- ============== Part 4 =============== -->
            <!-- ============== Part 4 =============== -->
            <div id="tab4" class="row">
            <h4 class="header part center">ส่วนที่ 4 ผลการตรวจวินิจฉัย </h4>
            <div class="form-body">
                
                <div class="row">
                    <div class="input-field col l6 s12">    
                      <label for="date_part4">23.วันที่(ว-ด-ป)</label>    
                      <input id="date_part4" name="date_part4" type="text" class="datepicker picker__input" readonly="" tabindex="-1" aria-haspopup="true" aria-expanded="false" aria-readonly="false" value="<?php echo date("d-m-Y"); ?>" />    
                    </div>
                    <div class="input-field col l6 s12">
                      <input name="user_part4" id="user_part4" type="text" value="{!! Session::get('name') !!}">
                      <label for="user_part4">ผู้ตรวจ</label>
                    </div>
                </div> <!-- date_part4 -->  
                
                <div class="row">
                     <div class="input-field">                     
                     <label>24.ผลการตรวจชิ้นเนื้อ:</label>
                    </div>
                    <div class="col s12">
                     <br /><br />
                      <p>     
                          <div class="col s12"> 
                              <input name="part4_1" type="radio" id="part4_11" value="1"  />
                              <label for="part4_11">1.Normol</label>
                          </div>
                          <div class="col s12">
                              <input name="part4_1" type="radio" id="part4_12" value="2" />
                              <label for="part4_12">2.Inflammation</label>
                          </div>
                          <div class="col s12">
                              <input name="part4_1" type="radio" id="part4_13" value="3" />
                              <label for="part4_13">3.Dysplasia</label>
                          </div>
                          <div class="col s12">
                            <div class="leftup">  
                                <div class="input-field">    
                                    <label>ระดับ:</label>
                                 </div>
                                <br />
                                <p>
                                      <div class="col s12">
                                          <input name="part4_2" type="radio" id="part4_21" value="1" checked  />
                                          <label for="part4_21">1.Mild</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="part4_2" type="radio" id="part4_22"  value="2" />
                                          <label for="part4_22">2.Moderate</label>   
                                      </div>
                                      <div class="col s12">
                                          <input name="part4_2" type="radio" id="part4_23"  value="3" />
                                          <label for="part4_23">3.Severe</label>   
                                      </div>                                     
                                </p>
                           </div>
                         </div> 
                        <div class="col s12"> 
                              <input name="part4_1" type="radio" id="part4_14" value="4" />
                              <label for="part4_14">4.Carcinoma in situ</label>
                          </div>
                          <div class="col s12">
                              <input name="part4_1" type="radio" id="part4_15" value="5" />
                              <label for="part4_15">5.Oral cancer stage1</label>
                          </div>

                          <div class="col s12">
                              <input name="part4_1" type="radio" id="part4_151" value="6" />
                              <label for="part4_151">6.Oral cancer stage2</label>
                          </div>
                          <div class="col s12">
                              <input name="part4_1" type="radio" id="part4_152" value="7" />
                              <label for="part4_152">7.Oral cancer stage3</label>
                          </div>
                          <div class="col s12">
                              <input name="part4_1" type="radio" id="part4_153" value="8" />
                              <label for="part4_153">8.Oral cancer stage4</label>
                          </div>

                          <div class="col s12">
                              <input name="part4_1" type="radio" id="part4_16" value="9" />
                              <label for="part4_16">9.Other</label>
                          </div>
                          <div class="input-field col s12">                                        
                              <input name="part4_1text" id="part4_1text" type="text">
                              <label for="part4_1text">โปรดระบุ</label> 
                          </div> 
                      </p>                         
                    </div>                                       
                </div><!-- type_part4_1, 4_2 -->

                 <div class="row">
                    <div class="input-field col s12">
                      <input name="definitive_diag" id="definitive_diag" type="text">
                      <label for="definitive_diag">25.Defintive diagnosis</label>
                    </div>
                </div> <!-- definitive_diag -->  

                <div class="row">
                    <div class="input-field">                     
                     <label>26.Group of lesion:</label>
                    </div>
                    <div class="col s12">
                     <br /><br />
                      <p>     
                          <div class="col s12"> 
                              <input name="part4_3" type="radio" id="part4_31" value="1"  />
                              <label for="part4_31">1.Potentially malignant disorder</label>
                          </div>
                          <div class="col s12">
                              <input name="part4_3" type="radio" id="part4_32" value="2" />
                              <label for="part4_32">2.Oral cancer</label>
                          </div>
                          <div class="col s12">
                              <input name="part4_3" type="radio" id="part4_33" value="3" />
                              <label for="part4_33">3.Other (Reactive, Autoimmune, Infeetion)</label>
                          </div>
                      </p>                         
                    </div>                                       
                </div><!-- type_part4_3 -->

                <div class="row">
                    <div class="input-field">                     
                     <label>27.Treatment:</label>
                    </div>
                    <div class="col s12">
                     <br /><br />
                      <p>     
                                                 
                          <div class="col s12">
                                 <input name="part4_4" type="radio" id="part4_41" value="1"  />
                                 <label for="part4_41">1.Medication</label>
                          </div>
                          <div class="input-field col s12">
                                 <input name="part4_41_text" id="part4_41_text" type="text">
                                 <label for="part4_41_text">โปรดระบุ</label>
                          </div>
                          
                          <div class="col s12">
                              <input name="part4_4" type="radio" id="part4_42" value="2" />
                              <label for="part4_42">2.Surgery</label>
                          </div>
                          <div class="input-field col s12">
                                 <input name="part4_42_text" id="part4_42_text" type="text">
                                 <label for="part4_42_text">โปรดระบุ</label> 
                          </div>
                        
                          <div class="col s12">
                              <input name="part4_4" type="radio" id="part4_43" value="3" />
                              <label for="part4_43">3.Follow up (month)</label>
                          </div>
                          <div class="input-field col s12">
                                 <input name="part4_43_text" id="part4_43_text" type="text">
                                 <label for="part4_43_text">โปรดระบุ</label> 
                          </div>
                        
                           <div class="col s12">
                              <input name="part4_4" type="radio" id="part4_44" value="4" />
                              <label for="part4_44">4.Refer (สถานพยาบาล)</label>
                          </div>
                          <div class="input-field col s12">
                                 <input name="part4_44_text" id="part4_44_text" type="text">
                                 <label for="part4_44_text">โปรดระบุ</label>
                          </div>
                        
                      </p>                         
                    </div>                                       
                </div><!-- type_part4_4 -->
            
            </div><!-- .form-body 4 -->  
            </div>
            @endif




            <!-- ============== แนบ File =============== -->
            <!-- ============== แนบ File =============== -->
            <!-- ============== แนบ File =============== -->
            <div id="tab5" class="row">
            <h4 class="header part center">ข้อมูลอื่น ๆ</h4>
            <div class="form-body">
                
                <!-- File All -->
                <div class="row">
                   <div class="col s12">
                      <h2 class="header">ข้อมูลไฟล์เอกสาร</h2>
                        
                        <div class="file-field input-field">
                            <div class="btn">
                              <span>แนบไฟล์ 1</span>
                              <input name="file1" id="file1" type="file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" placeholder="เลือกไฟล์ที่ต้องการ">
                            </div>
                          </div>
                          <div class="file-field input-field">
                            <div class="btn">
                              <span>แนบไฟล์ 2</span>
                              <input name="file2" id="file2" type="file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" placeholder="เลือกไฟล์ที่ต้องการ">
                            </div>
                          </div>
                        <div class="file-field input-field">
                            <div class="btn">
                              <span>แนบไฟล์ 3</span>
                              <input name="file3" id="file3" type="file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" placeholder="เลือกไฟล์ที่ต้องการ">
                            </div>
                          </div>
                          <div class="file-field input-field">
                            <div class="btn">
                              <span>แนบไฟล์ 4</span>
                              <input name="file4" id="file4" type="file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" placeholder="เลือกไฟล์ที่ต้องการ">
                            </div>
                          </div>
                          <div class="file-field input-field">
                            <div class="btn">
                              <span>แนบไฟล์ 5</span>
                              <input name="file5" id="file5" type="file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text" placeholder="เลือกไฟล์ที่ต้องการ">
                            </div>
                          </div>
                              
                   </div>
                </div>
            
            </div><!-- .form-body แนบ File -->  
            </div>



            <div class="row">
            <div class="col s12 center">
                
                  <button class="cd-popup-trigger btn waves-effect waves-light" type="submit" name="action">
                      บันทึก
                    <i class="mdi-content-send right"></i>
                  </button>
        
            </div>
            </div>

            
            {!! Form::close() !!}<!-- form -->

            
            
        </div>       
    </div> 

@endsection
