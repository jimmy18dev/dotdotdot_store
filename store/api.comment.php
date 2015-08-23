<?php
require_once'config/autoload.php';
header("Content-type: text/json");

$authen = $me->Authentication_token(array('member_id' => $_POST['member_id'],'token' => $_POST['token']));

// API Request $_POST
if($_POST['calling'] != ''){
	switch ($_POST['calling']) {
		case 'Comment':
			switch ($_POST['action']) {
				case 'Submit':
					if($_POST['comment_id'] == 0){
						// Create new comment
						if($authen && $site->OffensiveWord($_POST['message'])){

							// Get post data
							$post->GetPost(array('post_id' => $_POST['post_id']));

							// Create new comment
							$dataset = $comment->CreateComment(array(
								'parent_id' 	=> $_POST['parent_id'],
								'token' 		=> $_POST['token'],
								'member_id' 	=> $_POST['member_id'],
								'post_id' 		=> $post->id,
								'message' 		=> $_POST['message'],
								'type' 			=> $_POST['type'],
							));

							// Save Activity
							$activity->ActivityCreate(array(
								'member_id' 	=> $_POST['member_id'],
								'token' 		=> $_POST['token'],
								'place_id' 		=> '',
								'action' 		=> 'new_comment',
								'to_place_id' 	=> $post->place_id,
								'to_post_id' 	=> $post->id,
								'to_member_id' 	=> '',
								'to_comment_id' => $dataset['comment_id'],
								'to_image_id' 	=> '',
								'type' 			=> 'normal',
								'status' 		=> 'unread',
							));

							// Post time update
							$post->PostTimeUpdated(array('post_id' => $post->id));

							// Post total comment update
							$post->UpdateTotalComment(array('post_id' => $post->id));

							// Update priority
							$member->CalculatePriority(array('member_id' => $post->poster_id));

							// Create notification to post owner
							$notification->CreateNotification(array('to_post_id' => $post->id,));

							$me->SendCommentNotification(array(
								'post_id' => $post->id,
								'member_id' => $_POST['member_id'],
							));

							$api->successMessage('Comment Created.',$dataset['comment_id'],$dataset);
						}
						else{
							$api->errorMessage('Access Token Error!');
						}
					}
					else{
						// Edit this comment
						if($authen && $site->OffensiveWord($_POST['message'])){

							$dataset = $comment->EditComment(array(
								'comment_id' 	=> $_POST['comment_id'],
								'member_id' 	=> $_POST['member_id'],
								'message' 		=> $_POST['message'],
							));

							// Save Activity
							$activity->ActivityCreate(array(
								'member_id' 	=> $_POST['member_id'],
								'token' 		=> $_POST['token'],
								'place_id' 		=> '',
								'action' 		=> 'edit_comment',
								'to_place_id' 	=> '',
								'to_post_id' 	=> '',
								'to_member_id' 	=> '',
								'to_comment_id' => $_POST['comment_id'],
								'to_image_id' 	=> '',
								'type' 			=> 'normal',
								'status' 		=> 'active',
							));

							$api->successMessage('Comment Edited.',$dataset['comment_id'],$dataset);
						}
						else{
							$api->errorMessage('Access Token Error!');
						}
					}
					break;
				case 'DeleteRequest':
					if($authen){

						// Get post data
						$post->GetPost(array('post_id' => $_POST['post_id']));

						$comment->DeleteRequestComment(array(
							'comment_id' 	=> $_POST['comment_id'],
							'member_id' 	=> $_POST['member_id'],
						));

						// Post total comment update
						$post->UpdateTotalComment(array('post_id' => $post->id));

						// Save Activity
						$activity->ActivityCreate(array(
							'member_id' 	=> $_POST['member_id'],
							'token' 		=> $_POST['token'],
							'place_id' 		=> '',
							'action' 		=> 'delete_comment',
							'to_place_id' 	=> '',
							'to_post_id' 	=> $post->id,
							'to_member_id' 	=> '',
							'to_comment_id' => $_POST['comment_id'],
							'to_image_id' 	=> '',
							'type' 			=> 'normal',
							'status' 		=> 'unread',
						));

						// Update priority
						$member->CalculatePriority(array('member_id' => $post->poster_id));

						$api->successMessage('Comment Delete Request successed.',$_POST['comment_id'],'');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;

				// For administrator only
				case 'DeleteComment':
					if($authen && $me->type == "administrator"){
						$comment->DeleteComment(array('comment_id' => $_POST['comment_id'],));
						$api->successMessage('Comment deleted by administrator.','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				case 'ArchiveComment':
					if($authen && $me->type == "administrator"){
						$comment->ArchiveComment(array('comment_id' => $_POST['comment_id'],));
						$api->successMessage('Comment archived by administrator.','','');
					}
					else{
						$api->errorMessage('Access Token Error!');
					}
					break;
				default:
					break;
			}
			break;
		default:
			$api->errorMessage('COMMENT POST API ERROR!');
			break;
	}
}

// API Request $_GET
else if($_GET['calling'] != ''){
	switch ($_GET['calling']) {
		case 'Comment':
			switch ($_GET['action']) {
				case 'List':
					$dataset = $comment->ListComment(array(
						'post_id' 	=> $_GET['post_id'],
						'format' 	=> 'json',
					));
					$api->exportJson($message,$dataset);
					break;
				case 'LiveComment':
					$dataset = $comment->LiveComment(array(
						'export' => 'json',
						'time_now' => $_GET['time_now'],
						'search' => $_GET['search'],
					));

					$api->exportJson($_GET['search'].'Live Comment for live page.',$dataset);
					break;
				default:
					break;
			}
			break;
		default:
			$api->errorMessage('COMMENT GET API ERROR!');
			break;
	}
}

// API Request is Fail or Null calling
else{
	$api->errorMessage('API NOT FOUND!');
}

exit();
?>