<script>
$("#cheque_book_count_of_leaves").on('change',function(){
    if($(this).val() < 1){
        alert('You must have a count greater than zero');
        $(this).val('');
        $(this).css('border','1px red solid');
    }
});
</script>