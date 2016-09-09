<?php
/**
 * Tatoeba Project, free collaborative creation of multilingual corpuses project
 * Copyright (C) 2009  HO Ngoc Phuong Trang <tranglich@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  Tatoeba
 * @author   HO Ngoc Phuong Trang <tranglich@gmail.com>
 * @license  Affero General Public License
 * @link     http://tatoeba.org
 */

/**
 * Display all comments on the sentences own by a specific user
 *
 * @category SentenceComments
 * @package  Views
 * @author   HO Ngoc Phuong Trang <tranglich@gmail.com>
 * @license  Affero General Public License
 * @link     http://tatoeba.org
 */

$this->set('title_for_layout', $pages->formatTitle(
    format(__("Comments on {user}'s sentences", true), array('user' => $userName))
));
?>
<div id="annexe_content">
    <?php
        echo $this->element(
        'users_menu', 
        array('username' => $userName)
    );
    ?>
</div>

<div id="main_content">
    <div class="section">
    <?php
    if ($userExists === false) {
        echo '<h2>';
        echo format(
            __("There's no user called {username}", true),
            array('username' => $userName)
        );
        echo '</h2>';

        echo $html->link(__('Go back to previous page', true), $backLink);
    } elseif ($noComment === true) {
        echo '<h2>';
        echo format(
            __("{user} has no comment posted on his/her sentences", true),
            array('user' => $userName)
        );
        echo '</h2>';

        echo $html->link(__('Go back to previous page', true), $backLink);

    } else {
        ?>
        <h2>
            <?php 
            echo $paginator->counter(
                array(
                    'format' => format(
                        __('Comments on {user}\'s sentences (total&nbsp;{n})', true),
                        array('user' => $userName, 'n' => '%count%')
                    )
                )
            ); 
            ?>
        </h2>
        
        
        <?php 
        $paginatorUrl = array($userName);
        $pagination->display($paginatorUrl);
        ?>
        
        
        <div class="comments">
        <?php
        foreach ($userComments as $i=>$comment) {
            $menu = $comments->getMenuForComment(
                $comment['SentenceComment'],
                $commentsPermissions[$i],
                CurrentUser::isMember()
            );

            echo $this->element(
                'messages/comment',
                array(
                    'comment' => $comment,
                    'menu' => $menu
                )
            );
        }
        ?>
        </div>
        
        
        <?php
        $pagination->display($paginatorUrl);
        
    }
    ?> 
    </div>
</div>




