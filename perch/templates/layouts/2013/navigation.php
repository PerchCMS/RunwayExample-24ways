    <nav class="navigation" role="navigation" id="menu">
        <h1 class="hidden">Browse 24 ways</h1>
<?php
    if (perch_layout_var('traverse', true)) {
        echo '<div class="nav nav-traverse">';

            switch(perch_layout_var('section', true)) {
                case 'archives':
                    $label = 'year';
                    break;
                case 'authors':
                    $label = 'author';
                    break;
                case 'topics':
                    $label = 'topic';
                    break;
                case 'article':
                    $label = 'article';
                    break;
            }

            if (perch_layout_var('prev_url', true)) {
                echo '<a class="nav_item nav_prev" rel="prev" href="'.PerchUtil::html(perch_layout_var('prev_url', true), true).'" data-sequence-title="'.PerchUtil::html(perch_layout_var('prev_title', true), true).'" data-icon="&#x2190;">Previous '.$label.'</a>';
            }

            if (perch_layout_var('next_url', true)) {
                echo '<a class="nav_item nav_next" rel="next" href="'.PerchUtil::html(perch_layout_var('next_url', true), true).'" data-sequence-title="'.PerchUtil::html(perch_layout_var('next_title', true), true).'" data-icon="&#x2192;">Next '.$label.'</a>';
            }


        echo '</div><!--/.nav-traverse-->';
    }
?>
        <?php 
            perch_content_custom('Topics', array(
                'page'=>'/topics',
                'template'=>'topics/nav.html',
                'sort'=>'name',
                'sort-order'=>'ASC',
            ));
        ?>

        <form class="search" role="search" id="search" action="/search/">
            <fieldset class="field-search">
                <legend class="hidden">Search 24 ways</legend>
                <label class="field_label label" for="q">Keywords</label>
                <input class="field_input input" type="search" id="q" name="q" placeholder="e.g. CSS, Design, Research&#8230;"/>
                <input class="field_button button" type="submit" value="Search"/>

            </fieldset>
        </form><!--/.search-->

        <ul class="nav nav-site">
            <li class="nav_item<?php if (perch_layout_var('section', true) == "archives"): ?> is-active<?php endif ?>"><a href="/archives/">Archives</a></li>
            <li class="nav_item<?php if (perch_layout_var('section', true) == "topics"): ?> is-active<?php endif ?>"><a href="/topics/">Topics</a></li>
            <li class="nav_item<?php if (perch_layout_var('section', true) == "authors"): ?> is-active<?php endif ?>"><a href="/authors/">Authors</a></li>
            <li class="nav_item<?php if (perch_layout_var('section', true) == "about"): ?> is-active<?php endif ?>"><a href="/about/">About</a></li>
        </ul><!--/.nav-site-->

    </nav><!--/@navigation-->
