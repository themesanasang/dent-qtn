(function(){
    
    
    
    
     $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    
    
      
     
     /**
     * check error login
     */
    $('#username, #password').keydown(function() {
        $('#error-login').hide();
    });
    
    
    
    
    
    /**
     * sideNav Menu
     */
    $(".button-collapse").sideNav();



    /**
     * image Box
     */
     $('.materialboxed').materialbox();
    
    
    
    
    /**
     * tab sticky
     */ 
   $(".center-tab").sticky({
       topSpacing:60,
       bottomSpacing:480
   });
  
   $("html, body").animate({
        scrollTop: 0
    }, 600);    
   $('.tab-top').click(function(){
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return true;
   });    
    
    
    
    
    
    /**
     * check ie
     */
    check_ie();
    
    
    
    
     /**
     * loaded page
     */
	/*setTimeout(function(){
		$('body').addClass('loaded');
		$('h1').css('color','#212121');
	}, 500);*/
    
    
    
    
    
         
      var $searchbar  = $('#searchbar');
    
      $('#wrapper-content').on('click', function(e){
          if($searchbar.is(":visible")) {
               $searchbar.slideToggle(300, function(){
                // callback after search bar animation
              });
          }
      });

      $('#searchtoggl').on('click', function(e){
        e.preventDefault();         

        if($(this).attr('id') == 'searchtoggl') {
          if(!$searchbar.is(":visible")) { 
                         
          } else {             
            
          }

          $searchbar.slideToggle(300, function(){
            // callback after search bar animation
          });
        }
      });
    
    
    
    
     /**
     * ================= form
     */
    $('select').material_select(); 
    
    $( "select option:first-child" ).attr("disabled", "");
    $( "select option:first-child" ).attr("selected", "");
    
    $("#fullname, #user_part4").on("keypress", function(e) {
       
        var allowedEng = true; //อนุญาตให้คีย์อังกฤษ
        var allowedThai = true; //อนุญาตให้คีย์ไทย
        var allowedNum = false; //อนุญาตให้คีย์ตัวเลข
        
        var k = e.keyCode || e.which;
        
        /* เช็คตัวเลข 0-9 */
        if (k>=48 && k<=57) { return allowedNum; }

        /* เช็คคีย์อังกฤษ a-z, A-Z */
        if ((k>=65 && k<=90) || (k>=97 && k<=122)) { return allowedEng; }

        /* เช็คคีย์ไทย ทั้งแบบ non-unicode และ unicode */
        if ((k>=161 && k<=255) || (k>=3585 && k<=3675)) { return allowedThai; }
        
    });
    var creditInput = document.getElementById('cid');
      if (creditInput) {
        new Formatter(creditInput, {
            'pattern': '{{9}}-{{9999}}-{{99999}}-{{99}}-{{9}}'
        });
      }
    var ageInput = document.getElementById('age');
      if (ageInput) {
        new Formatter(ageInput, {
            'pattern': '{{999}}'
        });
      }
    var eageInput = document.getElementById('e-age');
      if (eageInput) {
        new Formatter(eageInput, {
            'pattern': '{{999}}'
        });
      }
    var telInput = document.getElementById('tel');
      if (telInput) {
        new Formatter(telInput, {
            'pattern': '{{999}}-{{999999}}'
        });
      }
    var etelInput = document.getElementById('e-tel');
      if (etelInput) {
        new Formatter(etelInput, {
            'pattern': '{{999}}-{{999999}}'
        });
      }
    var mobileInput = document.getElementById('mobile');
      if (mobileInput) {
        new Formatter(mobileInput, {
            'pattern': '{{99}}-{{9999}}-{{9999}}'
        });
      }
    var emobileInput = document.getElementById('e-mobile');
      if (emobileInput) {
        new Formatter(emobileInput, {
            'pattern': '{{99}}-{{9999}}-{{9999}}'
        });
      }
    var nexttimeInput = document.getElementById('nexttime');
      if (nexttimeInput) {
        new Formatter(nexttimeInput, {
            'pattern': '{{99}}:{{99}}:{{99}}'
        });
      }
    var nexttimeInput = document.getElementById('e-nexttime');
      if (nexttimeInput) {
        new Formatter(nexttimeInput, {
            'pattern': '{{99}}:{{99}}:{{99}}'
        });
      }
    
   
    
    
    
    
    
    //----school
     $('#textschool, #e-textschool').hide();
    $('#school1, #school2, #school3, #school4, #school5').click(function(){
        $('#textschool').hide();
    });  
    $('#school6').click(function(){
        $('#textschool').show();
    });
    $('#e-school1, #e-school2, #e-school3, #e-school4, #e-school5').click(function(){
        $('#e-textschool').hide();
    });  
    $('#e-school6').click(function(){
        $('#e-textschool').show();
    });
    if( $('#e-school6').is(":checked") ){
        $('#e-textschool').show();
    }
    
    
    
    
    
    
    //---work
    $('#textwork, #e-textwork').hide(); 
    $('#work1, #work2, #work3, #work4, #work5').click(function(){
        $('#textwork').hide();
    });  
     $('#work6').click(function(){
        $('#textwork').show();
    });
    $('#e-work1, #e-work2, #e-work3, #e-work4, #e-work5').click(function(){
        $('#e-textwork').hide();
    });  
     $('#e-work6').click(function(){
        $('#e-textwork').show();
    });
    if( $('#e-work6').is(":checked") ){
        $('#e-textwork').show();
    }
       
    
    
    
    
    
    //-----เลือกจังหวัด
    $('#chwpart').change(function() { 
        $.get( "getAmphur/"+$('#chwpart').val(), function( data ) {
             $('#amppart').html( data );            
        });   
        
        $('#tmbpart').html( '<option value="" disabled selected>กรุณาเลือก</option>' );  
    });
    $('#amppart').change(function() {  
        $.get( "getDistrict/"+$('#chwpart').val()+'/'+$('#amppart').val(), function( data ) {
             $('#tmbpart').html( data );            
        });     
    });
    //-----เลือกจังหวัด Edit
    $('#e-chwpart').change(function() { 
        $.get( "../getAmphur/"+$('#e-chwpart').val(), function( data ) {
             $('#e-amppart').html( data );            
        });   
        
        $('#e-tmbpart').html( '<option value="" disabled selected>กรุณาเลือก</option>' );  
    });
    $('#e-amppart').change(function() {  
        $.get( "../getDistrict/"+$('#e-chwpart').val()+'/'+$('#e-amppart').val(), function( data ) {
             $('#e-tmbpart').html( data );            
        });     
    });

    //------user
    //-----เลือกจังหวัด
    $('#u-chwpart').change(function() { 
        $.get( "getAmphur/"+$('#u-chwpart').val(), function( data ) {
             $('#u-amppart').html( data );            
        });   
        
        $('#u-tmbpart').html( '<option value="" disabled selected>กรุณาเลือก</option>' );  
    });
    $('#u-amppart').change(function() {  
        $.get( "getDistrict/"+$('#u-chwpart').val()+'/'+$('#u-amppart').val(), function( data ) {
             $('#u-tmbpart').html( data );            
        });     
    });
    //-----เลือกจังหวัด Edit
    $('#ue-chwpart').change(function() { 
        $.get( "../getAmphur/"+$('#ue-chwpart').val(), function( data ) {
             $('#ue-amppart').html( data );            
        });   
        
        $('#ue-tmbpart').html( '<option value="" disabled selected>กรุณาเลือก</option>' );  
    });
    $('#ue-amppart').change(function() {  
        $.get( "../getDistrict/"+$('#ue-chwpart').val()+'/'+$('#ue-amppart').val(), function( data ) {
             $('#ue-tmbpart').html( data );            
        });     
    });
    
    
    
    
    
    
    
    //-----smoking
    $('#smokingday').attr("disabled", "");
    $('#smokinglong').attr("disabled", "");
    $('#smokingstop').attr("disabled", "");
    $('#smoking1').click(function(){
        $('#smokingday').attr("disabled", "");
        $('#smokinglong').attr("disabled", "");
        $('#smokingstop').attr("disabled", ""); 
    });
    $('#smoking2').click(function(){
          $('#smokingday').removeAttr("disabled", "");
          $('#smokinglong').removeAttr("disabled", "");
          $('#smokingstop').attr("disabled", ""); 
          $('#smokingday').focus();
    });
    $('#smoking3').click(function(){
         $('#smokingstop').removeAttr("disabled", ""); 
         $('#smokingday').attr("disabled", "");
         $('#smokinglong').attr("disabled", "");
         $('#smokingstop').focus();
    });
    
    //-----smoking Edit
    $('#e-smokingday').attr("disabled", "");
    $('#e-smokinglong').attr("disabled", "");
    $('#e-smokingstop').attr("disabled", "");
    $('#e-smoking1').click(function(){
        $('#e-smokingday').attr("disabled", "");
        $('#e-smokinglong').attr("disabled", "");
        $('#e-smokingstop').attr("disabled", ""); 
    });
    $('#e-smoking2').click(function(){
          $('#e-smokingday').removeAttr("disabled", "");
          $('#e-smokinglong').removeAttr("disabled", "");
          $('#e-smokingstop').attr("disabled", ""); 
          $('#e-smokingday').focus();
    });
    $('#e-smoking3').click(function(){
         $('#e-smokingstop').removeAttr("disabled", ""); 
         $('#e-smokingday').attr("disabled", "");
         $('#e-smokinglong').attr("disabled", "");
         $('#e-smokingstop').focus();
    });
    if( $('#e-smokingstop').val() != '' ){      
        $('#e-smokingstop').removeAttr("disabled", "");
    }
    if( $('#e-smokingday').val() != '' ){
        $('#e-smokingday').removeAttr("disabled", "");
    }
    if( $('#e-smokinglong').val() != '' ){
        $('#e-smokinglong').removeAttr("disabled", "");
    }
    
    
    
    
    
    
     //-----hasnus
    $('#nuslong').attr("disabled", "");
    $('#nusstop').attr("disabled", "");
    $('#hasnus1').click(function(){
         $('#nuslong').attr("disabled", "");
         $('#nusstop').attr("disabled", "");
    });
    $('#hasnus2').click(function(){
          $('#nuslong').removeAttr("disabled", "");
          $('#nuslong').focus();
          $('#nusstop').attr("disabled", ""); 
    });
    $('#hasnus3').click(function(){
         $('#nusstop').removeAttr("disabled", ""); 
         $('#nusstop').focus();
         $('#nuslong').attr("disabled", "");
    });
    
    //-----hasnus Edit
    $('#e-nuslong').attr("disabled", "");
    $('#e-nusstop').attr("disabled", "");
    $('#e-hasnus1').click(function(){
         $('#e-nuslong').attr("disabled", "");
         $('#e-nusstop').attr("disabled", "");
    });
    $('#e-hasnus2').click(function(){
          $('#e-nuslong').removeAttr("disabled", "");
          $('#e-nuslong').focus();
          $('#e-nusstop').attr("disabled", ""); 
    });
    $('#e-hasnus3').click(function(){
         $('#e-nusstop').removeAttr("disabled", ""); 
         $('#e-nusstop').focus();
         $('#e-nuslong').attr("disabled", "");
    });
    if( $('#e-nusstop').val() != '' ){
        $('#e-nusstop').removeAttr("disabled", "");
    }
    if( $('#e-nuslong').val() != '' ){
        $('#e-nuslong').removeAttr("disabled", "");
    }
    
    
    
    
    
    
     //-----hasareca
    $('#arecalong').attr("disabled", "");
    $('#arecastop').attr("disabled", "");
    $('#hasareca1').click(function(){
         $('#arecalong').attr("disabled", "");
         $('#arecastop').attr("disabled", "");
    });
    $('#hasareca2').click(function(){
          $('#arecalong').removeAttr("disabled", "");
          $('#arecalong').focus();
          $('#arecastop').attr("disabled", ""); 
    });
    $('#hasareca3').click(function(){
         $('#arecastop').removeAttr("disabled", ""); 
         $('#arecastop').focus();
         $('#arecalong').attr("disabled", "");
    });
    
     //-----hasareca Edit
    $('#e-arecalong').attr("disabled", "");
    $('#e-arecastop').attr("disabled", "");
    $('#e-hasareca1').click(function(){
         $('#e-arecalong').attr("disabled", "");
         $('#e-arecastop').attr("disabled", "");
    });
    $('#e-hasareca2').click(function(){
          $('#e-arecalong').removeAttr("disabled", "");
          $('#e-arecalong').focus();
          $('#e-arecastop').attr("disabled", ""); 
    });
    $('#e-hasareca3').click(function(){
         $('#e-arecastop').removeAttr("disabled", ""); 
         $('#e-arecastop').focus();
         $('#e-arecalong').attr("disabled", "");
    });
     if( $('#e-arecastop').val() != '' ){
        $('#e-arecastop').removeAttr("disabled", "");
    }
    if( $('#e-arecalong').val() != '' ){
        $('#e-arecalong').removeAttr("disabled", "");
    }
    
    
    
    
    
    
    
    //------alcohol
    $('#drinktype1, #drinktype2, #drinktype3, #drinktype4, #drinktype5, #drinktypetext').attr("disabled", "");
    $('#drinkunittext, #drinkunit1, #drinkunit2, #drinkunit3, #drinkunit4, #drinkunit5, #drinkunit6').attr("disabled", "");
    $('#alcohollong').attr("disabled", "");
    $('#alcoholstop').attr("disabled", "");
    $('#alcohol1').click(function(){
        $('#drinktype1, #drinktype2, #drinktype3, #drinktype4, #drinktype5, #drinktypetext').attr("disabled", "");
        $('#drinkunittext, #drinkunit1, #drinkunit2, #drinkunit3, #drinkunit4, #drinkunit5, #drinkunit6').attr("disabled", "");
        $('#alcohollong').attr("disabled", ""); 
        $('#alcoholstop').attr("disabled", "");
    });
    $('#alcohol2').click(function(){
        $('#drinktype1, #drinktype2, #drinktype3, #drinktype4, #drinktype5').removeAttr("disabled", "");
        $('#drinkunittext, #drinkunit1, #drinkunit2, #drinkunit3, #drinkunit4, #drinkunit5, #drinkunit6').removeAttr("disabled", "");
        $('#alcohollong').removeAttr("disabled", "");  
        
        $('#drinktypetext').attr("disabled", "");
        
        $('#alcoholstop').attr("disabled", "");
    });
     $('#drinktype1, #drinktype2, #drinktype3, #drinktype4').click(function(){
         $('#drinktypetext').attr("disabled", "");
    }); 
    $('#drinktype5').click(function(){
         $('#drinktypetext').removeAttr("disabled", "");
        $('#drinktypetext').focus();
    });   
    $('#alcohol3').click(function(){
        $('#drinktype1, #drinktype2, #drinktype3, #drinktype4, #drinktype5, #drinktypetext').attr("disabled", "");
        $('#drinkunittext, #drinkunit1, #drinkunit2, #drinkunit3, #drinkunit4, #drinkunit5, #drinkunit6').attr("disabled", "");
        $('#alcohollong').attr("disabled", "");
        $('#alcoholstop').removeAttr("disabled", "");
        $('#alcoholstop').focus();
    });
    
    //------alcohol Edit
    $('#e-drinktype1, #e-drinktype2, #e-drinktype3, #e-drinktype4, #e-drinktype5, #e-drinktypetext').attr("disabled", "");
    $('#e-drinkunittext, #e-drinkunit1, #e-drinkunit2, #e-drinkunit3, #e-drinkunit4, #e-drinkunit5, #e-drinkunit6').attr("disabled", "");
    $('#e-alcohollong').attr("disabled", "");
    $('#e-alcoholstop').attr("disabled", "");
    $('#e-alcohol1').click(function(){
        $('#e-drinktype1, #e-drinktype2, #e-drinktype3, #e-drinktype4, #e-drinktype5, #e-drinktypetext').attr("disabled", "");
        $('#e-drinkunittext, #e-drinkunit1, #e-drinkunit2, #e-drinkunit3, #e-drinkunit4, #e-drinkunit5, #e-drinkunit6').attr("disabled", "");
        $('#e-alcohollong').attr("disabled", ""); 
        $('#e-alcoholstop').attr("disabled", "");
    });
    $('#e-alcohol2').click(function(){
        $('#e-drinktype1, #e-drinktype2, #e-drinktype3, #e-drinktype4, #e-drinktype5').removeAttr("disabled", "");
        $('#e-drinkunittext, #e-drinkunit1, #e-drinkunit2, #e-drinkunit3, #e-drinkunit4, #e-drinkunit5, #e-drinkunit6').removeAttr("disabled", "");
        $('#e-alcohollong').removeAttr("disabled", "");  
        
        $('#e-drinktypetext').attr("disabled", "");
        
        $('#e-alcoholstop').attr("disabled", "");
    });
     $('#e-drinktype1, #e-drinktype2, #e-drinktype3, #e-drinktype4').click(function(){
         $('#e-drinktypetext').attr("disabled", "");
    }); 
    $('#e-drinktype5').click(function(){
         $('#e-drinktypetext').removeAttr("disabled", "");
        $('#e-drinktypetext').focus();
    });   
    $('#e-alcohol3').click(function(){
        $('#e-drinktype1, #e-drinktype2, #e-drinktype3, #e-drinktype4, #e-drinktype5, #e-drinktypetext').attr("disabled", "");
        $('#e-drinkunittext, #e-drinkunit1, #e-drinkunit2, #e-drinkunit3, #e-drinkunit4, #e-drinkunit5, #e-drinkunit6').attr("disabled", "");
        $('#e-alcohollong').attr("disabled", "");
        $('#e-alcoholstop').removeAttr("disabled", "");
        $('#e-alcoholstop').focus();
    });
    if( $('#e-alcohol2').is(":checked") ){
        $('#e-drinktype1, #e-drinktype2, #e-drinktype3, #e-drinktype4, #e-drinktype5').removeAttr("disabled", "");
        $('#e-drinkunittext, #e-drinkunit1, #e-drinkunit2, #e-drinkunit3, #e-drinkunit4, #e-drinkunit5, #e-drinkunit6').removeAttr("disabled", "");
        $('#e-alcohollong').removeAttr("disabled", "");  
        
        $('#e-drinktypetext').attr("disabled", "");
        
        $('#e-alcoholstop').attr("disabled", "");
    }
    if( $('#e-alcoholstop').val() != '' ){
        $('#e-alcoholstop').removeAttr("disabled", "");
    }
    
    
    
    
    
    
    
    //-----hascancer
    $('#cancer1, #cancer2, #cancer3, #cancer4, #textcancer').attr("disabled", "");
     $('#hascancer1').click(function(){
         $('#cancer1, #cancer2, #cancer3, #cancer4, #textcancer').attr("disabled", "");
    }); 
    $('#hascancer2').click(function(){
         $('#cancer1, #cancer2, #cancer3, #cancer4').removeAttr("disabled", "");
    });
    $('#cancer1, #cancer2, #cancer3').click(function(){
         $('#textcancer').attr("disabled", "");
    }); 
    $('#cancer4').click(function(){
         $('#textcancer').removeAttr("disabled", "");
         $('#textcancer').focus();
    }); 
    
    //-----hascancer Edit
    $('#e-cancer1, #e-cancer2, #e-cancer3, #e-cancer4, #e-textcancer').attr("disabled", "");
     $('#e-hascancer1').click(function(){
         $('#e-cancer1, #e-cancer2, #e-cancer3, #e-cancer4, #e-textcancer').attr("disabled", "");
    }); 
    $('#e-hascancer2').click(function(){
         $('#e-cancer1, #e-cancer2, #e-cancer3, #e-cancer4').removeAttr("disabled", "");
    });
    $('#e-cancer1, #e-cancer2, #e-cancer3').click(function(){
         $('#e-textcancer').attr("disabled", "");
    }); 
    $('#e-cancer4').click(function(){
         $('#e-textcancer').removeAttr("disabled", "");
         $('#e-textcancer').focus();
    }); 
     if( $('#e-hascancer2').is(":checked") ){
        $('#e-cancer1, #e-cancer2, #e-cancer3, #e-cancer4').removeAttr("disabled", "");
     }
    if( $('#e-textcancer').val() != '' ){
        $('#e-textcancer').removeAttr("disabled", "");
    }
    
    
    
    
    
    
    
    //-----sun
    $('#worksun').attr("disabled", "");
    $('#sun1').click(function(){
         $('#worksun').attr("disabled", "");
    }); 
    $('#sun2').click(function(){
         $('#worksun').removeAttr("disabled", "");
         $('#worksun').focus();
    });
    
    //-----sun Edit
    $('#e-worksun').attr("disabled", "");
    $('#e-sun1').click(function(){
         $('#e-worksun').attr("disabled", "");
    }); 
    $('#e-sun2').click(function(){
         $('#e-worksun').removeAttr("disabled", "");
         $('#e-worksun').focus();
    }); 
     if( $('#e-sun2').is(":checked") ){
         $('#e-worksun').removeAttr("disabled", "");
         $('#e-worksun').focus(); 
     }
    
    
    
    
    
    //-----type_part3_5, 3_6
     $('#part3_61, #part3_62, #part3_63, #part3_64, #part3_65, #textpart3_6').attr("disabled", "");
     $('#part3_51').click(function(){
         $('#part3_61, #part3_62, #part3_63, #part3_64, #part3_65, #textpart3_6').attr("disabled", "");
    }); 
    $('#part3_52').click(function(){
         $('#part3_61, #part3_62, #part3_63, #part3_65, #part3_64').removeAttr("disabled", "");
    });
    $('#part3_61, #part3_62, #part3_63, #part3_64').click(function(){
         if($('#part3_65').is(':checked')){
            $('#textpart3_6').removeAttr("disabled", "");
         }
    }); 
    $('#part3_65').click(function(){
        if($('#part3_65').is(':checked')){
          $('#textpart3_6').removeAttr("disabled", "");
          $('#textpart3_6').focus();
        }else{
          $('#textpart3_6').attr("disabled", "");
          $('#textpart3_6').val('');
        }
    });
    
     //-----type_part3_5, 3_6 Edit
     $('#e-part3_61, #e-part3_62, #e-part3_63, #e-part3_64, #e-part3_65, #e-textpart3_6').attr("disabled", "");
     $('#e-part3_51').click(function(){
         $('#e-part3_61, #e-part3_62, #e-part3_63, #e-part3_64, #e-part3_65, #e-textpart3_6').attr("disabled", "");
    }); 
    $('#e-part3_52').click(function(){
         $('#e-part3_61, #e-part3_62, #e-part3_63, #e-part3_64, #e-part3_65').removeAttr("disabled", "");
    });
    $('#e-part3_61, #e-part3_62, #e-part3_63, #e-part3_64').click(function(){
        if($('#part3_65').is(':checked')){
            $('#e-textpart3_6').attr("disabled", "");
        }
    }); 
    $('#e-part3_65').click(function(){
        if($('#e-part3_65').is(':checked')){
          $('#e-textpart3_6').removeAttr("disabled", "");
          $('#e-textpart3_6').focus();
        }else{
          $('#e-textpart3_6').attr("disabled", "");
          $('#e-textpart3_6').val('');
        }
    });
     if( $('#e-part3_52').is(":checked") ){
         $('#e-part3_61, #e-part3_62, #e-part3_63, #e-part3_64, #e-part3_65').removeAttr("disabled", "");
     }
    if( $('#e-textpart3_6').val() != '' ){
        $('#e-textpart3_6').removeAttr("disabled", "");
    }
    
    
    
    
    
    
    //-------type_part4   
    $('.datepicker').pickadate({
        selectMonths: true,// Creates a dropdown to control month
        selectYears: 15,// Creates a dropdown of 15 years to control year
        // The title label to use for the month nav buttons
        labelMonthNext: 'เดือนถัดไป',
        labelMonthPrev: 'เดือนก่อนหน้า',
        // The title label to use for the dropdown selectors
        labelMonthSelect: 'เลือกเดือน',
        labelYearSelect: 'เลือกปี',
        // Months and weekdays
        monthsFull: [ 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม' ],
        monthsShort: [ 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.' ],
        weekdaysFull: [ 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์' ],
        weekdaysShort: [ 'อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส' ],
        // Materialize modified
        weekdaysLetter: [ 'อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส' ],
        // Today and clear
        today: 'วันนี้',
        clear: 'ลบ',
        close: 'ปิด',
        // The format to show on the `input` element
        format: 'd-mm-yyyy',
        onOpen: function() {            
            if( $('.datepicker').val() != "" ){  
                var arrayDate=$('.datepicker').val().split("-");       
                arrayDate[2] = parseInt(arrayDate[2]);  
                $('.datepicker').val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
            }  
            setTimeout(function(){  
                $.each($(".picker__select--year option"),function(j,k){                 
                    var textYear = parseInt($(".picker__select--year option").eq(j).val())+543;  
                    $(".picker__select--year option").eq(j).text(textYear);  
                });              
            },50); 
            
            $('.picker__year-display').html( parseInt($(".picker__select--year option:selected").val())+543 );
        },
        onSet: function(event) {   
            /*if( $('.datepicker').val() != "" ){           
                var arrayDate = $('.datepicker').val().split(" ");  
                arrayDate[2] = parseInt(arrayDate[2]);  
                $('.datepicker').val(arrayDate[0]+" "+arrayDate[1]+" "+arrayDate[2]);      
             }  */
             setTimeout(function(){  
                $.each($(".picker__select--year option"),function(j,k){                 
                    var textYear = parseInt($(".picker__select--year option").eq(j).val())+543;  
                    $(".picker__select--year option").eq(j).text(textYear);  
                });               
            },50);  
            
            $('.picker__year-display').html( parseInt($(".picker__select--year option:selected").val())+543 );
        },
        onClose: function() {          
            if( $('.datepicker').val() != "" ){           
                var arrayDate = $('.datepicker').val().split("-");  
                arrayDate[2] = parseInt(arrayDate[2]);  
                $('.datepicker').val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
            }  
        }         
    });
    
    
    
    
    
    //-------type_part4 1  
    $('#part4_21, #part4_22, #part4_23, #part4_1text, #part4_171, #part4_172, #part4_173').attr("disabled", "");
    $('#part4_11, #part4_12, #part4_13, #part4_14, #part4_16, #part4_17').click(function(){
         $('#part4_21, #part4_22, #part4_23, #part4_1text, #part4_171, #part4_172, #part4_173').attr("disabled", "");
         $('#part4_1text').val('');
    });   
    $('#part4_13').click(function(){
        $('#part4_21, #part4_22, #part4_23').removeAttr("disabled", "");
        $('#part4_1text').attr("disabled", "");
        $('#part4_1text').val('');
    });
    $('#part4_17').click(function(){
        $('#part4_171, #part4_172, #part4_173').removeAttr("disabled", "");
        $('#part4_1text').attr("disabled", "");
        $('#part4_1text').val('');
    });  

    $('#part4_16').click(function(){
        $('#part4_1text').removeAttr("disabled", "");
        $('#part4_1text').focus();
        $('#part4_21, #part4_22, #part4_23').attr("disabled", "");
        $('#part4_1text').val('');
    });

    $('#part4_15').click(function(){
        $('#part4_151text').removeAttr("disabled", "");
        $('#part4_151text').attr("readonly", "");
        $('#part4_151text').val('');

        //Model box
        //$('#modal1').openModal(); 
        $('#modal1').openModal({
            dismissible: false, // Modal can be dismissed by clicking outside of the modal
            opacity: .5, // Opacity of modal background
            in_duration: 300, // Transition in duration
            out_duration: 200, // Transition out duration
            ready: function() { 

            }, // Callback for Modal open
            complete: function() { 

            } // Callback for Modal close
          }
        );

    });

    $('#modalClose').click(function(){
      $('#part4_15').removeAttr("checked", "");
      //$('#part4_151text').attr("disabled", "");
    });

    $('#modalSave').click(function(){
        viewStageNew();
    });


    
    
    //-------type_part4 1 Edit  
    $('#e-part4_21, #e-part4_22, #e-part4_23, #e-part4_1text, #e-part4_171, #e-part4_172, #e-part4_173').attr("disabled", "");
    $('#e-part4_11, #e-part4_12, #e-part4_13, #e-part4_14, #e-part4_16, #e-part4_17').click(function(){
         $('#e-part4_21, #e-part4_22, #e-part4_23, #e-part4_1text, #e-part4_171, #e-part4_172, #e-part4_173').attr("disabled", "");
    });   
    $('#e-part4_13').click(function(){
        $('#e-part4_21, #e-part4_22, #e-part4_23').removeAttr("disabled", "");
        $('#e-part4_1text').attr("disabled", "");
        $('#e-part4_1text').val('');
    });
    $('#e-part4_16').click(function(){
        $('#e-part4_1text').removeAttr("disabled", "");
        $('#e-part4_1text').focus();
        $('#e-part4_21, #e-part4_22, #e-part4_23').attr("disabled", "");
    });
    if( $('#e-part4_16').is(":checked") ){
        $('#e-part4_1text').removeAttr("disabled", "");
        $('#e-part4_1text').focus();
        $('#e-part4_21, #e-part4_22, #e-part4_23').attr("disabled", "");
    }
    $('#e-part4_17').click(function(){
        $('#e-part4_171, #e-part4_172, #e-part4_173').removeAttr("disabled", "");
        $('#e-part4_1text').attr("disabled", "");
        $('#e-part4_1text').val('');
    });

    if( $('#e-part4_13').is(":checked") ){
        $('#e-part4_21, #e-part4_22, #e-part4_23').removeAttr("disabled", "");
    }

    if( $('#e-part4_17').is(":checked") ){
        $('#e-part4_171, #e-part4_172, #e-part4_173').removeAttr("disabled", "");
     }

    $('#e-part4_15').click(function(){
        $('#e-part4_151text').removeAttr("disabled", "");
        $('#e-part4_151text').attr("readonly", "");
        $('#e-part4_151text').focus();
        $('#e-part4_151text').val('');

        $('#modal2').openModal({
            dismissible: false, // Modal can be dismissed by clicking outside of the modal
            opacity: .5, // Opacity of modal background
            in_duration: 300, // Transition in duration
            out_duration: 200, // Transition out duration
            ready: function() { 

            }, // Callback for Modal open
            complete: function() { 

            } // Callback for Modal close
          }
        );

    });

    $('#modalCloseEdit').click(function(){
        viewStageEdit();
    });

    $('#modalSaveEdit').click(function(){
        viewStageEdit();
    });

    

    
    
    
    
    
    //-------type_part4 2  
    $('#part4_42_text, #part4_43_text, #part4_44_text').attr("disabled", "");   
    $('#part4_41').click(function(){
        $('#part4_41_text').removeAttr("disabled", "");
        $('#part4_41_text').focus();
        $(' #part4_42_text, #part4_43_text, #part4_44_text').attr("disabled", "");
    });
    $('#part4_42').click(function(){
        $('#part4_42_text').removeAttr("disabled", "");
        $('#part4_42_text').focus();
        $(' #part4_41_text, #part4_43_text, #part4_44_text').attr("disabled", "");
    });
    $('#part4_43').click(function(){
        $('#part4_43_text').removeAttr("disabled", "");
        $('#part4_43_text').focus();
        $(' #part4_41_text, #part4_42_text, #part4_44_text').attr("disabled", "");
    });
    $('#part4_44').click(function(){
        $('#part4_44_text').removeAttr("disabled", "");
        $('#part4_44_text').focus();
        $(' #part4_41_text, #part4_42_text, #part4_43_text').attr("disabled", "");
    });
    
    //-------type_part4 2  Edit 
    $('#e-part4_42_text, #e-part4_43_text, #e-part4_44_text').attr("disabled", "");   
    $('#e-part4_41').click(function(){
        $('#e-part4_41_text').removeAttr("disabled", "");
        $('#e-part4_41_text').focus();
        $('#e-part4_42_text, #e-part4_43_text, #e-part4_44_text').attr("disabled", "");
    });
    $('#e-part4_42').click(function(){
        $('#e-part4_42_text').removeAttr("disabled", "");
        $('#e-part4_42_text').focus();
        $('#e-part4_41_text, #e-part4_43_text, #e-part4_44_text').attr("disabled", "");
    });
    $('#e-part4_43').click(function(){
        $('#e-part4_43_text').removeAttr("disabled", "");
        $('#e-part4_43_text').focus();
        $('#e-part4_41_text, #e-part4_42_text, #e-part4_44_text').attr("disabled", "");
    });
    $('#e-part4_44').click(function(){
        $('#e-part4_44_text').removeAttr("disabled", "");
        $('#e-part4_44_text').focus();
        $('#e-part4_41_text, #e-part4_42_text, #e-part4_43_text').attr("disabled", "");
    });
    
    if( $('#e-part4_41').is(":checked") ){
        $('#e-part4_41_text').removeAttr("disabled", "");
        $('#e-part4_41_text').focus();
        $('#e-part4_42_text, #e-part4_43_text, #e-part4_44_text').attr("disabled", "");
    }
    if( $('#e-part4_42').is(":checked") ){
        $('#e-part4_42_text').removeAttr("disabled", "");
        $('#e-part4_42_text').focus();
        $('#e-part4_41_text, #e-part4_43_text, #e-part4_44_text').attr("disabled", "");
    }
    if( $('#e-part4_43').is(":checked") ){
         $('#e-part4_43_text').removeAttr("disabled", "");
        $('#e-part4_43_text').focus();
        $('#e-part4_41_text, #e-part4_42_text, #e-part4_44_text').attr("disabled", "");
    }
    if( $('#e-part4_44').is(":checked") ){
        $('#e-part4_44_text').removeAttr("disabled", "");
        $('#e-part4_44_text').focus();
        $('#e-part4_41_text, #e-part4_42_text, #e-part4_43_text').attr("disabled", "");
    }
    
    
    





//==================== Image pic1, pic2, pic3 ======================//
var value_pic1 = 0
$('#c_pic_1').click(function(){
  value_pic1 +=90;
  $("#p_pic_1").rotate({ animateTo:value_pic1 });
});

var value_pic2 = 0
$('#c_pic_2').click(function(){
  value_pic2 +=90;
  $("#p_pic_2").rotate({ animateTo:value_pic2 });
});

var value_pic3 = 0
$('#c_pic_3').click(function(){
  value_pic3 +=90;
  $("#p_pic_3").rotate({ animateTo:value_pic3 });
});

var value_pic4 = 0
$('#c_pic_4').click(function(){
  value_pic4 +=90;
  $("#p_pic_4").rotate({ animateTo:value_pic4 });
});

var value_pic5 = 0
$('#c_pic_5').click(function(){
  value_pic5 +=90;
  $("#p_pic_5").rotate({ animateTo:value_pic5 });
});

var value_pic6 = 0
$('#c_pic_6').click(function(){
  value_pic6 +=90;
  $("#p_pic_6").rotate({ animateTo:value_pic6 });
});






    
    
    
     //============= save data Confirm ===================//
    //open popup
	$('.cd-popup-trigger').on('click', function(event){
		event.preventDefault();
		$('.cd-popup').addClass('is-visible');
	});
	
	//close popup
	$('.cd-popup').on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup') ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('.cd-popup').removeClass('is-visible');
	    }
    });
    $('.c-no').on('click', function(){	
        $('.cd-popup').removeClass('is-visible');		
	});
    $('.c-ok').on('click', function(){	

        //var formdata = $('#screenform').serialize();

        var formdata = new FormData($('#screenform')[0]);
            //formdata.append('file1', $('input[type=file]')[0].files[0]); 

        $.ajax({type:'POST', url: 'screen', data:formdata,
          processData: false,
          contentType: false,
            success: function(result) {
                $('.cd-popup').removeClass('is-visible');
                
                if ($.isEmptyObject(result.error)) {

                    $('#er-fullname, #er-cid, #er-age, #er-chwpart, #er-amppart, #er-tmbpart').removeClass('validate');
                                     
                    //=======save data ok========//
                    if(result.success == 'ok')
                    {              
                        window.location.assign('screen');
                    }                                                   
                }
                else{
                     $('#er-fullname, #er-cid, #er-age, #er-chwpart, #er-amppart, #er-tmbpart').removeClass('validate');
                    
                    //=======save data error========//
                    for (var key in result.error) {
                        if( typeof result.error.fullname !== "undefined" ){
                            $('#er-fullname').addClass('validate');
                        }
                        if( typeof result.error.cid !== "undefined" ){
                            $('#er-cid').addClass('validate');
                        }
                        if( typeof result.error.age !== "undefined" ){
                            $('#er-age').addClass('validate');
                        }
                         if( typeof result.error.chwpart !== "undefined" ){
                            $('#er-chwpart').addClass('validate');
                        }
                         if( typeof result.error.amppart !== "undefined" ){
                            $('#er-amppart').addClass('validate');
                        }
                         if( typeof result.error.tmbpart !== "undefined" ){
                            $('#er-tmbpart').addClass('validate');
                        }
                    }
                }
                
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
                return true;
                
            }
        });		
	});








//======================  Treatment page  ==================//

$('.datepicker_vstdate').pickadate({
        selectMonths: true,// Creates a dropdown to control month
        selectYears: 15,// Creates a dropdown of 15 years to control year
        // The title label to use for the month nav buttons
        labelMonthNext: 'เดือนถัดไป',
        labelMonthPrev: 'เดือนก่อนหน้า',
        // The title label to use for the dropdown selectors
        labelMonthSelect: 'เลือกเดือน',
        labelYearSelect: 'เลือกปี',
        // Months and weekdays
        monthsFull: [ 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม' ],
        monthsShort: [ 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.' ],
        weekdaysFull: [ 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์' ],
        weekdaysShort: [ 'อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส' ],
        // Materialize modified
        weekdaysLetter: [ 'อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส' ],
        // Today and clear
        today: 'วันนี้',
        clear: 'ลบ',
        close: 'ปิด',
        // The format to show on the `input` element
        format: 'd-mm-yyyy',
        onOpen: function() {            
            if( $('.datepicker').val() != "" ){  
                var arrayDate=$('.datepicker').val().split("-");       
                arrayDate[2] = parseInt(arrayDate[2]);  
                $('.datepicker').val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
            }  
            setTimeout(function(){  
                $.each($(".picker__select--year option"),function(j,k){                 
                    var textYear = parseInt($(".picker__select--year option").eq(j).val())+543;  
                    $(".picker__select--year option").eq(j).text(textYear);  
                });              
            },50); 
            
            $('.picker__year-display').html( parseInt($(".picker__select--year option:selected").val())+543 );
        },
        onSet: function(event) {   
             setTimeout(function(){  
                $.each($(".picker__select--year option"),function(j,k){                 
                    var textYear = parseInt($(".picker__select--year option").eq(j).val())+543;  
                    $(".picker__select--year option").eq(j).text(textYear);  
                });               
            },50);  
            
            $('.picker__year-display').html( parseInt($(".picker__select--year option:selected").val())+543 );
        },
        onClose: function() {          
            if( $('.datepicker').val() != "" ){           
                var arrayDate = $('.datepicker').val().split("-");  
                arrayDate[2] = parseInt(arrayDate[2]);  
                $('.datepicker').val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
            }  
        }         
    });


    $('.datepicker_nextdate').pickadate({
        selectMonths: true,// Creates a dropdown to control month
        selectYears: 15,// Creates a dropdown of 15 years to control year
        // The title label to use for the month nav buttons
        labelMonthNext: 'เดือนถัดไป',
        labelMonthPrev: 'เดือนก่อนหน้า',
        // The title label to use for the dropdown selectors
        labelMonthSelect: 'เลือกเดือน',
        labelYearSelect: 'เลือกปี',
        // Months and weekdays
        monthsFull: [ 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม' ],
        monthsShort: [ 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.' ],
        weekdaysFull: [ 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์' ],
        weekdaysShort: [ 'อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส' ],
        // Materialize modified
        weekdaysLetter: [ 'อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส' ],
        // Today and clear
        today: 'วันนี้',
        clear: 'ลบ',
        close: 'ปิด',
        // The format to show on the `input` element
        format: 'd-mm-yyyy',
        onOpen: function() {            
            if( $('.datepicker').val() != "" ){  
                var arrayDate=$('.datepicker').val().split("-");       
                arrayDate[2] = parseInt(arrayDate[2]);  
                $('.datepicker').val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
            }  
            setTimeout(function(){  
                $.each($(".picker__select--year option"),function(j,k){                 
                    var textYear = parseInt($(".picker__select--year option").eq(j).val())+543;  
                    $(".picker__select--year option").eq(j).text(textYear);  
                });              
            },50); 
            
            $('.picker__year-display').html( parseInt($(".picker__select--year option:selected").val())+543 );
        },
        onSet: function(event) {   
             setTimeout(function(){  
                $.each($(".picker__select--year option"),function(j,k){                 
                    var textYear = parseInt($(".picker__select--year option").eq(j).val())+543;  
                    $(".picker__select--year option").eq(j).text(textYear);  
                });               
            },50);  
            
            $('.picker__year-display').html( parseInt($(".picker__select--year option:selected").val())+543 );
        },
        onClose: function() {          
            if( $('.datepicker').val() != "" ){           
                var arrayDate = $('.datepicker').val().split("-");  
                arrayDate[2] = parseInt(arrayDate[2]);  
                $('.datepicker').val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
            }  
        }         
    });
    
    
    




    
    //============= userTable ===================//
    
    var userTable = $('#userTable').dataTable( {              
        "bLengthChange": false,  
        "ordering": true,
        "iDisplayLength": 20,
        "language": {
            "lengthMenu": "",
            "zeroRecords": "ไม่มีข้อมูล",
            "info": "หน้า _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่มีข้อมูล",
            "sSearch": "ค้นหา: "            
        },"fnPreDrawCallback": function(oSettings, json) {   
           //$('#userTable_filter').addClass('input-field');  
        }
    } );
    
     $('.btn-user-delete').bind('ajax:success', function(e, data, status, xhr){        	      		
      	 $(e.target).closest('tr').remove();      	   
	 });	
    
    
    
    
    
    
    
    //============= screenTable ===================//
    
    var screenTable = $('#screenTable').dataTable( {              
        "bLengthChange": false,  
        "ordering": true,
        "iDisplayLength": 20,
        "language": {
            "lengthMenu": "",
            "zeroRecords": "ไม่มีข้อมูล",
            "info": "หน้า _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่มีข้อมูล",
            "sSearch": "ค้นหา: "            
        },"fnPreDrawCallback": function(oSettings, json) {   
           //$('#userTable_filter').addClass('input-field');  
        }
    } );
    
    $('.btn-screen-delete').bind('ajax:success', function(e, data, status, xhr){        	      		
      	 $(e.target).closest('tr').remove();      	   
	 });	
    
    
    
    
    
    
     //============= searchTable ===================//
    
    var searchTable = $('#searchTable').dataTable( {              
        "bLengthChange": false,
        "bFilter": false,
        "ordering": true,
        "iDisplayLength": 20,
        "language": {
            "lengthMenu": "",
            "zeroRecords": "ไม่มีข้อมูล",
            "info": "หน้า _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่มีข้อมูล",
            "sSearch": "ค้นหา: "            
        },"fnPreDrawCallback": function(oSettings, json) {   
           //$('#userTable_filter').addClass('input-field');  
        }
    } );

       	
    
    
    
    //============= patientTable ===================//
    
    var patientTable = $('#patientTable').dataTable( {              
        "bLengthChange": false,  
        "ordering": true,
        "iDisplayLength": 20,
        "language": {
            "lengthMenu": "",
            "zeroRecords": "ไม่มีข้อมูล",
            "info": "หน้า _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่มีข้อมูล",
            "sSearch": "ค้นหา: "            
        },"fnPreDrawCallback": function(oSettings, json) {   
           //$('#userTable_filter').addClass('input-field');  
        }
    } );

    $('.btn-patient-delete').bind('ajax:success', function(e, data, status, xhr){                    
         $(e.target).closest('tr').remove();           
    });





    //============= treatmentTable ===================//
    
    var treatmentTable = $('#treatmentTable').dataTable( {              
        "bLengthChange": false,  
        "ordering": true,
        "iDisplayLength": 20,
        "language": {
            "lengthMenu": "",
            "zeroRecords": "ไม่มีข้อมูล",
            "info": "หน้า _PAGE_ จาก _PAGES_",
            "infoEmpty": "ไม่มีข้อมูล",
            "sSearch": "ค้นหา: "            
        },"fnPreDrawCallback": function(oSettings, json) {   
           //$('#userTable_filter').addClass('input-field');  
        }
    } );

    $('.btn-treatment-delete').bind('ajax:success', function(e, data, status, xhr){                    
         $(e.target).closest('tr').remove();           
    });
     
    
    
    
    
    
})();





/**
* view stage new
*/
function viewStageNew(){
  var tumor;
  var nodes;
  var met;

  tumor = $("input[type='radio'][name='tumor']:checked");
  if (tumor.length > 0) {
      tumor = tumor.val();
  }else{
    tumor = 0;
  }

  nodes = $("input[type='radio'][name='nodes']:checked");
  if (nodes.length > 0) {
      nodes = nodes.val();
  }else{
    nodes = 0;
  }

  met = $("input[type='radio'][name='met']:checked");
  if (met.length > 0) {
      met = met.val();
  }else{
    met = 0;
  }

  $('#tumorAll').val(tumor);
  $('#nodesAll').val(nodes);
  $('#metAll').val(met);
  var resultStage = check_stage(tumor, nodes, met);
  $('#part4_151text').focus();
  $('#part4_151text').val(resultStage);
}






/**
* view stage edit
*/
function viewStageEdit(){
  var tumor;
  var nodes;
  var met;

  tumor = $("input[type='radio'][name='e_tumor']:checked");
  if (tumor.length > 0) {
      tumor = tumor.val();
  }else{
    tumor = 0;
  }

  nodes = $("input[type='radio'][name='e_nodes']:checked");
  if (nodes.length > 0) {
      nodes = nodes.val();
  }else{
    nodes = 0;
  }

  met = $("input[type='radio'][name='e_met']:checked");
  if (met.length > 0) {
      met = met.val();
  }else{
    met = 0;
  }

  $('#e-tumorAll').val(tumor);
  $('#e-nodesAll').val(nodes);
  $('#e-metAll').val(met);
  var resultStage = check_stage(tumor, nodes, met);
  $('#e-part4_151text').focus();
  $('#e-part4_151text').val(resultStage);
}







/**
* check stage
*/
function check_stage(tumor, nodes, met){

  var resultStage;

  //--------------1------------//

  if( tumor == '4' && nodes == '2' && met == '1' ){
    resultStage = 'Stage I';
  }

  //--------------2------------//

  if( tumor == '5' && nodes == '2' && met == '1' ){
    resultStage = 'Stage II';
  }

  //-------------3-------------//

  if( tumor == '6' && nodes == '2' && met == '1' ){
    resultStage = 'Stage III';
  }
  if( tumor == '4' && nodes == '3' && met == '1' ){
    resultStage = 'Stage III';
  }
  if( tumor == '5' && nodes == '3' && met == '1' ){
    resultStage = 'Stage III';
  }
  if( tumor == '6' && nodes == '3' && met == '1' ){
    resultStage = 'Stage III';
  }

  //-------------4-------------//

  if( tumor == '4' && nodes == '4' && met == '1' ){
    resultStage = 'Stage IVa';
  }
  if( tumor == '5' && nodes == '4' && met == '1' ){
    resultStage = 'Stage IVa';
  }
  if( tumor == '6' && nodes == '4' && met == '1' ){
    resultStage = 'Stage IVa';
  }
  if( (tumor == '7' || tumor == '8') && (nodes == '2' || nodes == '3' || nodes == '4') && met == '1' ){
    resultStage = 'Stage IVa';
  }

  //-------------5-------------//

  if( tumor == '9' && (nodes == '2' || nodes == '3' || nodes == '4' || nodes == '8') && met == '1' ){
    resultStage = 'Stage IVb';
  }
  if( tumor == '4' && nodes == '8' && met == '1' ){
    resultStage = 'Stage IVb';
  }
  if( tumor == '5' && nodes == '8' && met == '1' ){
    resultStage = 'Stage IVb';
  }
  if( tumor == '6' && nodes == '8' && met == '1' ){
    resultStage = 'Stage IVb';
  }
  if( (tumor == '7' || tumor == '8') && nodes == '8' && met == '1' ){
    resultStage = 'Stage IVb';
  }

  //-------------6-------------//

  if( met == '2' ){
    resultStage = 'Stage IVc';
  }

  return resultStage;

}



/**
 * check ie
 */
function check_ie(){
	var isIE8 = false;
    var isIE9 = false;
    var isIE10 = false;

    isIE8 = !!navigator.userAgent.match(/MSIE 8.0/);
    isIE9 = !!navigator.userAgent.match(/MSIE 9.0/);
    isIE10 = !!navigator.userAgent.match(/MSIE 10.0/);
 
    if (isIE10 || isIE9 || isIE8) {
        $('#loader-wrapper').hide();
    }
}

