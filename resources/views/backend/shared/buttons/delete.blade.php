<form action="{{ route($routeName.'.destroy' , ['id' => $row ]) }}" method="POST">
                                  @CSRF
                                  <input type="hidden" name="_method" value="delete"/>
                                  <button  rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Remove {{ $Model_name}}">
                                      <i class="material-icons">close</i>
                                  </button>
                                </form>
