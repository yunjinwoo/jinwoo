		<div class="paging">
			<a href="<?=$link_first?>" class="paging_btn paging_f"><span>맨처음 페이지</span></a>
			<a href="<?=$link_prev?>" class="paging_btn paging_p"><span>이전 페이지</span></a>
			<?php for($i = $start_page ; $i <= $last_page ;$i++) :?>
			<?php if( $i == $self_page ) : ?>
			<a href="<?=$link_default?>&amp;page=<?=$i?>"><strong><?=$i?></strong></a>
			<?php else :?>
			<a href="<?=$link_default?>&amp;page=<?=$i?>"><?=$i?></a>
			<?php endif ;?>
			<?php endfor; ?>
			<a href="<?=$link_next?>" class="paging_btn paging_n"><span>다음 페이지</span></a>
			<a href="<?=$link_last?>" class="paging_btn paging_l"><span>마지막 페이지</span></a>
		</div>