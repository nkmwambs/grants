<style>
        .profile-feed{
        margin-bottom:45px;
        }

        .post-type{
        margin-top:10px;
        }

#message_slider{
	margin:30px 25px 10px 25px;
}		

.chat_post{
	background-color:whitesmoke;
	padding:15px;
	border-radius:8px;
	margin-bottom:5px;
}
</style>  

<section class="profile-feed">
                        
				<?php echo form_open("" , array('id'=>'frm_chat','class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
					<textarea id="chat_message" name="message_detail_content" class="form-control autogrow" placeholder="What's on your mind?"></textarea>
                    
                    <div class="form-options">
                        
                        <div class="post-type">
                        
                            <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Upload a Picture">
                                <i class="entypo-camera"></i>
                            </a>
                        
                            <a href="#" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Attach a file">
                                <i class="entypo-attach"></i>
                            </a>
                            
                            <a href="" id="show_comments" class="tooltip-primary" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Show comments">
                                <i class="fa fa-bars"></i>
                            </a>
                            
                            <div type="button" id="post_comment" class="btn btn-primary pull-right">POST</div>
                        </div>
                        
                        
                    </div>
                </form>
                
				<div id='message_slider' class="hidden">
					
				</div>

            </section>

<script>

	$(document).ready(function(){
		let previous_chats = $("#previous_chats").clone();
		//previous_chats.removeClass('hidden');
		$("#message_slider").append(previous_chats.html());
	});

	$("#frm_chat a").on('click',function(ev){
		ev.preventDefault();
	});

	$("#show_comments").on('click',function(){
		$("#message_slider").toggleClass('hidden');		
	});

	$("#post_comment").on('click',function(){
		
		let chat_message = $('#chat_message').val();
		let url = "<?=base_url().$this->controller;?>/post_chat";
		let data = {'message_detail_content':chat_message,'item_id':'<?=$item_id;?>'};

		$.ajax({
			url:url,
			type:"POST",
			data:data,
			success:function(response){
				
				let obj = JSON.parse(response);
				let message = obj.message;
				let message_date = obj.message_date;
				let creator = obj.creator;

				$("#message_slider").prepend(chat_post(message, message_date, creator));
				$('#chat_message').val(null);
			}
		});
	});

	function chat_post(message, message_date, creator){
		let new_post = $("#chat_post").clone();
		new_post.removeAttr('id');
		new_post.removeClass('hidden');
		new_post.find('.message_holder').html(message);
		new_post.find('.timestamp').find('div').append(message_date);
		new_post.find('.user').find('div').append(creator);
		new_post.addClass('chat_post');

		return new_post;
	}
</script>

<div id='chat_post' class="row hidden">
	
		<div class='col-xs-7 message_holder'>

		</div>

		<div class="col-xs-2 user">
			<div class='pull-right'><i class='fa fa-user '> &nbsp; </i></div>
		</div>

		<div class="col-xs-2 timestamp">
			<div class='pull-right'><i class='fa fa-clock-o'></i> </div>
		</div>

		<div class="col-xs-1 icon_holder">
			<i  class='fa fa-pencil pull-right'></i>

			<i class='fa fa-trash pull-right'></i>
		</div>
</div>


<div id='previous_chats' class='hidden'>

<?php 
		if(isset($chat_messages)){
			foreach($chat_messages as $chat_message){		
	?>
		<div class='row chat_post'>
			<div class='col-xs-7'>
				<?=$chat_message['message'];?>
			</div>

			<div class="col-xs-2 user">
				<div class='pull-right'><i class='fa fa-user '></i> &nbsp; <?=$this->CI->user_model->get_user_full_name($chat_message['author']);?></div>
			</div>

			<div class="col-xs-2 timestamp">
				<div class='pull-right'><i class='fa fa-clock-o '></i> <?=$chat_message['message_date'];?></div>
			</div>
				
			<div class="col-xs-1 icon_holder">
				<i  class='fa fa-pencil pull-right'></i>

				<i class='fa fa-trash pull-right'></i>
			</div>
		</div>	
	<?php 
			}
		}
	?>
</div>


