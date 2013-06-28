

<h3>9.<?php echo getSubTitle() ; ?> : 계층 관계의 테이터들을 표현하는 트리</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		<ul>
			<li><h3>트리(tree) </h3>
<a href="http://www.joinc.co.kr/modules/moniwiki/wiki.php/Site/Database/DataStructure/Tree" target="_blank">[참고용 페이지]</a>
			
			<ul>
				<li>나무를 뒤집은 모습의 계층 구조 표현(조직도)
				<li>노드(내용)와 링크(선) , 깊이(depth)
			</ul>

			<dl>
				<dt>루트로드(root node)
				<dd>가장위에 위치한 노드
				
				<dt>단말로드(terminal node), 리프로드(leaft node) 
				<dd>가장 하단에위에 위치한 노드

				<dt>서브트리(subtree)
				<dd>임의의 노드를 선택 후 아래 노드들이 트리 구조

				<dt>부모노드(parent node)
				<dd>임의의 노드 바로 위 노드
				
				<dt>자식노드(children node)
				<dd>임의의 노드 바로 아래 노드

				<dt>형제노드(sibling node)
				<dd>부모 노드가 같은 노드
				
				<dt>레벨(level)
				<dd>루트 노드에서 임의의 노드까지의 링크 수
			</dl>

			<ul>
				<li>이진 트리 란?( binary tree ) : 모든 노드들의 자식 노드가 두개 이하인 트리
					<ul>
						<li>완전 이진 트리( complete binary tree)
						<li>포화 이진 트리( full binary tree )
					</ul>

					
				<li>이진 트리 의 표현 : 연결 리스트로 표현 가능 (좌,우)

				<li>이진 트리 의 순회 <a href="http://blog.daum.net/nothing-everything/7633844" target="_blank">[참고용 페이지]</a>
					<dl>
						<dt>전위 순회
						<dd>노드 방문 -> 왼쪽 서브 트리 방문 -> 오른쪽 서브 트리방문
					</dl>
					
					<dl>
						<dt>중위 순회
						<dd>왼쪽 서브 트리 방문 -> 노드 방문 -> 오른쪽 서브 트리방문
					</dl>
					
					<dl>
						<dt>후위 순회
						<dd>왼쪽 서브 트리 방문 -> 오른쪽 서브 트리방문 -> 노드 방문
					</dl>
			</ul>
			
		</ul>		
	</div>	
</div>