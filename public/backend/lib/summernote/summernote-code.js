$(function(){
    'use strict';

    // Inline editor
    var editor = new MediumEditor('.editable');

    // Summernote editor
    $('#summernote').summernote({
      height: 150,
      tooltip: false
    })

     // Summernote editor
     $('#summernote2').summernote({
      height: 150,
      tooltip: false
    })
  });