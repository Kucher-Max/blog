function fillspan(){
    var arr=$("#tags").val().split(";");
    $("#taglist").text("");
    arr.forEach(function(item,i,arr){
        if(item!="")
        $("#taglist").append(' <span style="font-size:14px" class="glyphicon glyphicon-remove label label-success">'+item+'</span>');
    })
}
$(document).ready(function(){
    $("#addtag").click(function(){
        var str=$("#tags").val();
        $("#tags").val(str+";"+$("#selectTags").val());
       
        fillspan();
        
    })
    $("body").delegate("#taglist .glyphicon-remove","click",function(){
        //console.log($(this).parent().children(".label-success").text())
        var str=$("#tags").val().replace($(this).text(),'');
        $("#tags").val(str);
        fillspan();
    })
    $(".add_picture").click(function(e){
        e.preventDefault();
        all=$('input[name="preview[]"]');
        if(all.length==11)return;
        field=$('input[name="preview[]"]:first').clone();
        //$(this).after(field);
        $(all[0]).after(field);
    })
    $(".search").keyup(function(event){
        event.preventDefault();
        if(($(this).val().length)>=1){
            var text=$(this).val();
            $.post('/get',{
                data:text,
                _token:$("#token").val()
            },function(data){
                var str='';
                for(i in data){
                    str+='<div class="row"><div class="col-md-12 "><div class="result-item"><a href="/tag/'+data[i]['id']+'">'+data[i]['name']+'</a></div></div></div>';
                    
                    
                };
                $(".search-result").html(str);
                var left=$(".form-group .search").offset().left,
                    top=$(".form-group .search").offset().top+$(".form-group .search").height()+20;
                $(".search-result").offset({top:top,left:left}).show();
                
                
            })
        }
    });
    $(document).mouseup(function (e) {
        var container = $(".search-result");
        if (container.has(e.target).length === 0 ){
            container.hide();
        };
    })
    $(".search").focusin(function(){
        if($(this).val().length>=1)
            $(".search-result").show();
    })

})