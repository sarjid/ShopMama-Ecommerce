$(document).ready(function() {
    $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id) {
            $.ajax({
                url: "{{  url('/get/subcategory/') }}/"+category_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                   var d =$('select[name="subcategory_id"]').empty();
                      $.each(data, function(key, value){

                          $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');

                      });

                },

            });
        } else {
            alert('danger');
        }

    });
    $('select[name="subcategory_id"]').on('change', function(){
        var subcategory_id = $(this).val();
        if(subcategory_id) {
            $.ajax({
                url: "{{  url('/get/subsubcategory/') }}/"+subcategory_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                   var d =$('select[name="subsubcategory_id"]').empty();
                      $.each(data, function(key, value){

                          $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');

                      });

                },

            });
        } else {
            alert('danger');
        }

    });
});
