<?php
require 'dbcon.php';
$uid=$_POST['id'];
$last_id=$_POST['last'];
 $propostqry=mysqli_query($conn,"SELECT * FROM post WHERE child_post_id='$uid' AND id<$last_id ORDER BY id DESC LIMIT 4");
								WHILE($propost=mysqli_fetch_assoc($propostqry)) {
								?>
                                    <div class="post-row" id="<?= $propost['id'] ?>">
                                        <div class="post-rw-hld">
                                            <div class="post-img">
											<?php if($propost['img_count']>0) {
												$proimages=explode(",",$propost['image']);
                                                for($i=0;$i<count($proimages);$i++) {   
											?>
											<img src="<?= $proimages[$i] ?>" alt="">
												<?php } }  ?>
											
											
											</div>
											<div class="videos">
											<?php if($propost['vid_count']>0) {
												$provid=explode(",",$propost['video']);
												for($i=0;$i<count($provid);$i++) { ?>   
											<video width="230" height="200" controls>
                                            <source src="<?= $provid[$i] ?>" type="video/mp4">
 
                                            </video>
											<?php } } ?>
											</div>
											</div>
											<div class="post-rw-hld">
                                            <div class="post-content">
                                                <h2><p class="user-nm"><?= $propost['title'] ?></p></h2>
                                                <p class="pst-text"><?= $propost['posts'] ?></p>
												<a href="<?= $propost['url'] ?>"><?= $propost['url'] ?></a>
                                            </div>
                                        </div>
                                    </div>
								<?php } ?>