

<h3>11.<?php echo getSubTitle() ; ?> : 관계가 있는 테이터들을 표현하는 그래프</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		<ul>
			<li><h3>그래프(graph) </h3>

			<dl>
				<dt>그래프란?
				<dd>쾨니히스베르크(Koenigsberg)의 다리 문제를 수학자 오일러(Euler)가<br />
				표현한 그림이 그래프의 시초<a href="http://user.chol.com/~sdhbkh/math-story/character-study-2/Koonigsberg.htm">[참고]</a>
				<dd>정점(vertex) A, B, C, D 가 있을때 정점과 정점 연결선을 간선(edge) 라고한다.
				<dd>정점에 연결된 간선의 수를 차수(degree) 라고한다.
				<dd>A, B 한 간선이면 인접(adjacent)) 라고한다.
				<dd>방에 따라 진입 차수(in-degree)과 진출 차수(out-degree) 으로 구분된다
				<dd>정점에서 정점까지 간선으로 연결된 정점을 나열한것이 경로(path)
				<dd>처음과 마지막 정점이 같은 경우 사이클(cycle) 
				
				
				<dt>무방향 그래프(undirected graph)
				<dd>방향성이 없는 간선

				<dt>방향 그래프(directed graph)
				<dd>방향성이 있는 간선

				<dt>완전그래프(complete graph) 
				<dd>모든 정점 사이에 간선이 있는 경우 

				<dt>가중 그래프(weighted graph)
				<dd>간선마다 가중치를 부여한 그래프
			</dl>

			<li>그래프 탐색
				<ul>
					<li>
						<dl>
							<dt>깊이 우선 탐색(DFS, depth first search)
							<dd>시작 정점에서 진행할수없을때까지 진행 후 되돌어가면서 미방문 정점 방문
						</dl>
					<li>
						<dl>
							<dt>너비 우선 탐색(BFS, breadth first search)
							<dd>시작 정점에서 연결된 모든 정점을 방문후 차례대로 미방문 정점 방문(depth)
						</dl>
				</ul>
		</ul>		
	</div>	
</div>