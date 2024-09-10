<?php
include "../../../koneksi.php";
//$connect = new PDO("mysql:host=localhost;dbname=sidayo", "root", "");

if(isset($_POST["rating_data"]))
{
	if ($_POST["rating_data"] == 1 || $_POST["rating_data"] == 2 || $_POST["rating_data"] == 3){
		$rating_data = 4;
	}
	else{
		$rating_data = $_POST["rating_data"];
	}

	$data = array(
		':kode_booking'		=>	$_POST["kode_booking"],
		':user_rating'		=>	$rating_data,
		//':user_review'		=>	$_POST["user_review"],
		':created_at'			=>	date('Y:m:d H:i:s')
	);

	$query = "
	INSERT INTO sidayoh_review 
	(kode_booking, user_rating, /*user_review,*/ created_at) 
	VALUES (:kode_booking, :user_rating, /*:user_review,*/ :created_at)
	";

	$statement = $db->prepare($query);

	$statement->execute($data);

	echo "Your Review & Rating Successfully Submitted";

}

if(isset($_POST["action"]))
{
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$query = "
	SELECT * FROM sidayoh_review 
	ORDER BY review_id DESC
	";

	$result = $db->query($query, PDO::FETCH_ASSOC);

	foreach($result as $row)
	{
		$review_content[] = array(
			'kode_booking'		=>	$row["kode_booking"],
			//'user_review'	=>	$row["user_review"],
			'rating'		=>	$row["user_rating"],
			'created_at'		=>	date('l jS, F Y h:i:s A', $row["created_at"])
		);

		if($row["user_rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["user_rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["user_rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["user_rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["user_rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>