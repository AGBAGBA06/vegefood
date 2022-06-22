<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="ti-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="ti-clipboard menu-icon"></i>
          <span class="menu-title">Creation</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{URL::to('/ajoutercategorie')}}">ajouter categorie</a></li>
            <li class="nav-item"><a class="nav-link" href="{{URL::to('/ajouterproduit')}}">ajouter produit</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url::to('/ajouterslider')}}">ajouter slider</a></li>
            
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="ti-layout menu-icon"></i>
          <span class="menu-title">Afficher</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/categories')}}">categorie</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/products')}}"> produit</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/slider')}}"> slider</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/commandes')}}"> commandes</a></li>
            
          </ul>
        </div>
      </li>
    </ul>
  </nav>
  <!-- partial -->