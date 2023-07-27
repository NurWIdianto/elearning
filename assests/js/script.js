$("#status").on("change", function(){
	var x = $("#status option:selected").attr("value");
	if(x=='mahasiswa'){
		$.ajax({
			type: "POST",
	        url: "register/nomor_mahasiswa",
	        success:function(result){ 
				$('#nomor').val(result);
				$('#nama').focus();
			},
			error:function(error){
				$('#nomor').attr('placeholder','gagal');
			}
		});
	}else{
		$.ajax({
			type: "POST",
	        url: "register/nomor_dosen",
	        success:function(result){ 
				$('#nomor').val(result);
				$('#nama').focus();
			},
			error:function(error){
				$('#nomor').attr('placeholder','gagal');
			}
		});
	}
});

