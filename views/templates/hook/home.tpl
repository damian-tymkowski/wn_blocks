{block name='wn_blocks'}
    {if $wnblocks[0]['products']!=null}
    <section class="wn_blocks">
        {foreach from=$wnblocks item=wnBlock}
            <div class="wn_block">
                <h3 class="wn_block__header">{$wnBlock['category']->name}</h3>

                <div class="slider_arrows">
                    <button class="wn_block__btnPrev wn_block__button wn_block__button--secondary"><img
                                src="./modules/wn_blocks/assets/icons/arrow-up.svg"/></button>
                    <button class="wn_block__btnNext wn_block__button wn_block__button--secondary"><img
                                src="./modules/wn_blocks/assets/icons/arrow-down.svg"/></button>
                </div>

                <div class="slick vertical-slider">
                    {foreach from=$wnBlock['products'] item=product}
                        <div class="wn_block__product">
                            {assign var='coverImage' value=Product::getCover($product['id_product'])}
                            {assign var='coverImageId' value="{$product['id_product']}-{$coverImage.id_image}"}

                            <img class="wn_block__image"
                                 src="{$link->getImageLink($product['link_rewrite'], $coverImageId, 'home_default')}"
                                 alt="product image"/>
                            <p class="wn_block__product--name">{$product['name']}</p>
                            <div class="wn_block__actions">
                                <p class="wn_block__product--price">{$product['price']|string_format:"%.2f"} zł</p>
                                <form action="{$urls.pages.cart}" method="post">
                                    <input type="hidden" name="token" value="{$static_token}">
                                    <input type="hidden" value="{$product['id_product']}" name="id_product">
                                    <label class="wn_block__form">
                                        <input type="number" value="1" class="wn_block__input input-group" name="qty">
                                        <button data-button-action="add-to-cart" class="wn_block__button"><img
                                                    src="./modules/wn_blocks/assets/icons/cart.svg"/></button>
                                    </label>
                                </form>
                            </div>
                        </div>
                    {/foreach}
                </div>
                <a class="wn_block__show-more" href={$link->getCategoryLink($wnBlock['category']->id, $wnBlock['category']->link_rewrite)|escape:'html':'UTF-8'}>więcej
                    z tej kategorii</a>
            </div>
        {/foreach}
    </section>
    {/if}
{/block}