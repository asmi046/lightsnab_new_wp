<?php 

/*
Template Name: Корзина
Template Post Type: page
*/

get_header(); ?>

    <?php get_template_part('template-parts/block-menu');?>
    <?php get_template_part('template-parts/header-category');?>

    <template id = "bascet">
        <table v-if = "bascet.length > 0" class = "bascet_page_table">
                    <thead>
                        <tr>   
                            <th class = "prev"></th>
                            <th class = "name">Название</th>
                            <th class = "count">Колличество</th>
                            <th class = "price">Цена</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for = "(item, index, key) in bascet" >
                            <td> <img :src = "item.picture" /> </td>
                            <td class = "name">
                                <div class = "b_tov_name">{{item.name}}</div>
                                <div class = "b_tov_sku">{{item.sku}} {{item.modtext}}</div>
                            </td>
                            <td>
                                <input type = "number"  @change = "recalcBascet" v-model="item.count" min = "0" />
                            </td>
                            <td class = "price">
                                <span class = "subtotalprice">{{item.subtotal}}</span>р
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>   
                            <td></td>
                            <td class = "name">Итого:</td>
                            <td>{{bascetCount}}</td>
                            <td class = "price"><span class = "totalprice">{{bascetSumm}}</span>р</td>
                        </tr>
                    </tfoot>
        </table>
        <strong v-else>Ваша корзина пуста</strong>
    </template>

    <template id = "bascet-form">
        <form v-show = "shoved" class = "bascet_form">
                <h2>Оформить заказ</h2>    
                <div class = "form-line">
                    <label for = "id_fio">Имя, Фамилия*</label>
                    <div class="form-item">    
                        <input id="id_fio" maxlength="255" name="fio" v-model="name" type="text" placeholder="Например, Александр">
                        
                    </div>
                </div>

                <div class="form-line">
                    <label for="id_email" id="p_id_email" class="form-label">E-mail*</label>
                    <div class="form-item">    
                        <input id="id_email" maxlength="255" name="email" v-model="mail"  type="email" placeholder="alex-ivanov@gmail.com">
                        
                    </div>
                </div>

                <div class="form-line">
                    <label for="id_phone" id="p_id_phone" class="form-label">Телефон*</label>
                    <div class="form-item">    
                        <input id="id_phone" maxlength="255" name="phone" v-model="phone" type="text" placeholder="+7-991-441-48-43">
                        
                    </div>
                </div>

                <div class="form-line">
                    <label for="id_address" id="p_id_address" class="form-label">Адрес</label>
                    <div class="form-item">    
                        <textarea cols="40" id="id_address" name="address" v-model="adres" rows="10"></textarea>
                        <div class="form-help-text">ул. Строителей, д. 10, корп. 12, кв. 38, под. 3, код: 58а</div>
                    </div>
                </div>

                <div class="form-line">
                    <label for="id_comment" id="p_id_comment" class="form-label">Комментарии</label>
                    <div class="form-item">    
                        <textarea cols="40" id="id_comment" name="comment" v-model="comment" rows="10"></textarea>
                        <div class="form-help-text">Позвонить курьеру за час до выезда.</div>  
                    </div>
                </div>

                <div class="form-line">
                    <label for="id_i_agree" id="p_id_i_agree" class="form-label">Я согласен (-на)</label>
                    <div class="form-item form-item-policy">    
                        <input v-model="checpolicy" id="id_i_agree" name="i_agree" type="checkbox">
                        <div class="form-help-text">Ставя отметку, я даю своё согласие на обработку моих персональных данных в соответствии с законом №152-ФЗ "О персональных данных" от 27.07.2006 и <a href="/page/i-agree/">принимаю условия пользовательского соглашения и политики в области обработки персональных данных</a>.</div>
                    </div>
                </div>

                <div class = "form_submit_line btn-wrapper">
                    <button @click.self  = "sendBascet" type = "button" class = "all-link">Оформить заказ</button>
                    <div v-show = "formNoValid" class = "no_feild">
                        Заполните все обязательные поля помеченные <span style = "color:#d3820f;">"*"</span>
                    </div>
                </div>
                
            </form>
    </template>

    <section class = "page_content">
        <div class = "container" id = "bascet_vue">
            <h1 class="category-title"><?the_title();?></h1>
            <div class = "bascet_content" >
                <bascet></bascet>
            </div>

            <bascetform></bascetform>
        </div>
    </section>
    
    


<?php get_footer(); ?> 