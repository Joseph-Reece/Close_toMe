

      <footer class="footer">
          <div class="container">
              <div class="row">
                  <div class="col-sm-3">
                      <div class="widget">
                          <h5 class="widgetheading">Our Contact</h5>
                          <address>
                              <strong>The chief Executive Officer,</strong>
                              <br>
                              <strong>Murang'a Level 5 Hospital,</strong>
                              <br>
                              <i class="icon-box"></i> <strong>P.O BOX 0945 00300,</strong>
                              <br>
                              <strong>Murang'a, Kenya.</strong>
                          </address>
                          <p>
                              <i class="fa fa-phone-square"></i>&nbsp;Cell: +254 714419825 <br>
                              <i class="fa fa-envelope-o"></i>&nbsp;Email: <a href="mailto:hospital@muranga.org">hospital@muranga.org</a>
                          </p>
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="widget">
                          <h5 class="widgetheading">Quick Links</h5>
                          <ul class="link-list">
                              <li><a class="" href="#">Latest Events</a></li>
                              <li><a class="" href="#">Patient feedback</a></li>
                              <li><a class="" href="#">Terms and conditions</a></li>
                              <li><a class="" href="#">Privacy policy</a></li>
                              <li><a class="" href="#">Career</a></li>
                              <li><a class="" href="#">Contact us</a></li>
                          </ul>
                      </div>
                  </div>


                  <div class="col-sm-3">
                      <div class="widget">
                          <h5 class="widgetheading">Social Network</h5>
                          <ul class="social-network">
                              <li><a class="" href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                              <li><a class="" href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                              <li><a class="" href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                              <li><a class="" href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                              <li><a class="" href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a>
                              </li>
                          </ul>
                      </div>

                  </div>


                  <div class="col-sm-3">
                      <div class="widget">
                          <h5 class="widgetheading">Recent News</h5>
                          <ul class="link-list">

                                 @if (count($posts)>0)
                                 @foreach ($posts as $post)

                                 <li><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></li>

                                 @endforeach
                          <a href="{{route('posts.index')}}" class="btn btn-primary">More  <span class="fa fa-caret-right"></span></a>
                                 @endif

                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          <div id="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="copyright">
                            <p>
                            <span>Copyright &copy;2020 | All rights reserved. <a href="/home" target="_blank">Murang' a Hospital</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6">
                        <ul class="social-network">
                            <li><a class="waves-effect waves-dark" href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                            <li><a class="waves-effect waves-dark" href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

      </footer>

<a href="#" class="scrollup "><i class="fa fa-angle-up active"></i></a>

