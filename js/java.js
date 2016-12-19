function geneImage(idImg,sizeTop=null,sizeBot=null,clrTop=null,clrBot=null,textTop,textBot){
	/*console.log($image,$type,$sizeTop,$sizeBot,$clrTop,$clrBot,$textTop,textBot);*/
	$.get('include/fonction.php',{


		sizeTop:sizeTop,
		sizeBot:sizeBot,
		clrTop:clrTop,
		clrBot:clrBot,
		textTop:textTop,
		textBot:textBot,
		idImg:idImg,


	})
    .done(function(data) {

    })
    .fail(function(data) {
        alert('Error: ' + data);
    });


}

function changeSize(champ,type){
	if (type=="add"){
		$(champ).val(parseInt($(champ).val())+1);
	}else{
		$(champ).val(parseInt($(champ).val())-1);
	}
}

function testChampRemplis(){
	if ($("#textBot").val()!="" || $("#textTop").val()!=""){
		return true;
	}else{
		return false;
	}
}
