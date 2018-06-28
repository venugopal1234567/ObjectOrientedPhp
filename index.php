<?php
  require 'classes/Database.php';

   $database = new Database;
   
   $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

   if($_POST['delete']){
   	 $delete_id = $_POST['delete_id'];
   	 $database->query('DELETE FROM posts WHERE id = :id');
   	 $database->bind(':id', $delete_id);
   	 $database->execute();
   }

   if($_POST['submit']){
   	  $id= $post['id'];
   	  $title = $post['title'];
   	  $body = $post['body'];
   	   $database->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');
   	   $database->bind(':title', $title);
   	   $database->bind(':body',$body);
   	   $database->bind(':id',$id);
   	   $database->execute();
   	/*   if($database->lastInsertId()){
   	   	echo "Post added";
   	   }
   	 */

   }

   $database->query('SELECT * FROM posts ');
   $row = $database->result();
?>

<h1>Add Post</h1>
<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
	<label>Post ID</label></br>
	<input type="text" name="id" placeholder="Specify title"/></br>
	<label>Post Title</label></br>
	<input type="text" name="title" placeholder="Add title"/>
</br>
<label>Post Body</label></br>
<textarea name="body"></textarea></br>
<input type="submit" name="submit" value="submit"/>
</form>



 <h1>Posts</h1>
 <div>
 	<?php foreach ($row as $row):?>
 		<div>
 			<h3><?php echo $row['title'];?></h3>
 			<p> <?php echo $row['body'];?></p>
 		</br>
 		<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
 		  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
          <input type="submit" name="delete" value="delete"/>
 	    </form>
 		</div>
 	<?php endforeach; ?>
 </div>