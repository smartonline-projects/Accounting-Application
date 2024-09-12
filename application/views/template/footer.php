<div class="page-footer-fixed">
<div class="footer">
	<div class="footer-inner">      
	  <?php echo $this->config->item('name_app');?> | Periode : <?php echo $this->M_global->_periodebulan().'-'.$this->M_global->_periodetahun();?>
	  | <?php echo $this->M_global->tgln();?><span id="jam" style="font-size: 18px;"></span></p>									  
	</div>
	
	<div class="footer-tools">	    
		<span class="go-top">
			<i class="fa fa-angle-up"></i>			
		</span>
	</div>
</div>
</div>

<script src="<?php echo base_url();?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/core/app.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/custom/jam.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/sweet-alert2/sweetalert2.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/sweet-alert2/sweetalert2.js"></script>
<script src="<?php echo base_url();?>assets/scripts/core/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/core/select2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/scripts/core/sheetjs.js" type="text/javascript"></script>




<script>
  initailizeSelect2();
  initailizeSelect2_barang();
  
  jQuery(document).ready(function() {
    App.init();	
  });
  
   window.onload = function()   {
     show2();         
   }
   
   function initailizeSelect2(){
   
   $(".select2_el").select2({
     ajax: {
       url: "<?php echo base_url();?>app/search",
       type: "post",
       dataType: 'json',
	   minimumInputLength: 3,
       delay: 250,
       data: function (params) {
          return {
            searchTerm: params.term // search term
          };
       },
	   
       processResults: function (response) {
          return {
             results: response
          };
       },
       cache: true
     }
   });
   }
   
   function initailizeSelect2_barang(){
   
   $(".select2_el_barang").select2({
     ajax: {
       url: "<?php echo base_url();?>app/search_barang",
       type: "post",
       dataType: 'json',
	   minimumInputLength: 3,
       delay: 250,
       data: function (params) {
          return {
            searchTerm: params.term // search term
          };
       },
	   
       processResults: function (response) {
          return {
             results: response
          };
       },
       cache: true
     }
   });
   }
   

function formatCurrency1(num) {
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
	cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	return (((sign)?'':'-') + '' + num + '.' + cents);
	//return (((sign)?'':'-') + '' + num);
	}

  function formatCurrency(fieldObj)
    {

        if (isNaN(fieldObj.value)) { return false; }
        fieldObj.value =formatCurrency1(fieldObj.value);
        return true;

  }

function tabE(obj,e){
      var e=(typeof event!='undefined')?window.event:e;// IE : Moz

      if(e.keyCode==13){
         var ele = document.forms[0].elements;

      for(var i=0;i<ele.length;i++){
          var q=(i==ele.length-1)?0:i+1;// if last element : if any other
      if(obj==ele[i]){ele[q].focus();break}
    }
    return false;
    }
    }

  
</script>
</html>
