<!doctype html>
<html>
<head>
<title>Training</title>
@include("layout.head")
<link rel="stylesheet" href="/css/main.css">
<script type="text/javascript">
$(function(){
	$('#training').addClass('active');
	$('.panel-heading').click(function(){
		var iconChildren = $(this).children().eq(-1);
		if(iconChildren.hasClass('glyphicon-chevron-down')){
			iconChildren.removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
		}else if(iconChildren.hasClass('glyphicon-chevron-up')){
			iconChildren.removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
		};
	});
	$('.list_hover').has('i').css('background','#D9EDF7');
})
</script>
</head>
<body class="body_grey">
@include("layout.header")
	<div class="container-fluid" id="training_container">
		<img src="/avatar/2" class="img_fit">
		<div class="training_title">
			<div>
				<h1>{{ $training->train_name }}</h1>
				<p>{{ $training->description }}</p>
			</div>
			<hr/>
			<div>
				@for($i = 1; $i <= $chapter_in -1; $i++)
					<i class="glyphicon glyphicon-star star-color"></i>
				@endfor
				@for($i = 1; $i <= $training->train_chapter - $chapter_in + 1; $i++)
					<i class="glyphicon glyphicon-star-empty star-color"></i>
				@endfor
				&nbsp;&nbsp;&nbsp;&nbsp;{{ $chapter_in -1 }} / {{ $training->train_chapter }}
			</div>
		</div>
	</div>
<div  class="panel-group training_group" id="accordion" aria-multiselectable="true">
@for($i = 1; $i <= $training->train_chapter; $i++)
<div class="panel panel-default">
	@if($i <= $chapter_in)
		<div class="panel-heading" data-toggle="collapse" href="#collapse_{{ $i }}" aria-expanded="true">
			<span>chapter{{ $i }}</span>
			<i class="glyphicon glyphicon-chevron-down glyphicon_right"></i>
		</div>
		<div id="collapse_{{ $i }}" class="panel-collapse collapse in">
			<div class="panel-body">
				<ul class="list-group">
				@if(isset($chapter[$i]))
					@foreach($chapter[$i] as $problem)
						<li class="list_hover list-group-item" onClick="window.location.href = '/training/{{ $problem->train_id }}/chapter{{ $problem->chapter_id }}/{{ $problem->train_problem_id }}';">
							<span>ID : {{ $problem->train_problem_id }}&nbsp;&nbsp;&nbsp;&nbsp;TITLE : {{ $problem->title }}
								@if($problem->ac)
								<i class="glyphicon glyphicon-ok"></i>
								@endif
							</span>
						</li>
					@endforeach
				@else
					<li class = "list_hover list-group-item">
						<span>Problems of this chapter have not been set or are used by a contest</span>
					</li>
				@endif
				</ul>
			</div>
	@else
		<div class="panel-heading" data-toggle="modal" data-target="#information">
			<span>chapter{{ $i }}</span>
			<i class="glyphicon glyphicon-lock glyphicon_right"></i>
		</div>
		<div id="collapse_{{ $i }}" class="panel-collapse collapse">
	@endif
	</div>
	</div>
@endfor
</div>
<div class="modal fade" id="information" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">Information</div>
			<div class="modal-body">Please  finish previous chapters to unlock this chapter</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default close" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>
<div style="padding-bottom: 40px"></div>
@include("layout.footer")
</body>
</html>