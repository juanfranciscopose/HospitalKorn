<div class="mt-4">
    <ul class="pagination pagination-sm">
        <li class="page-item" v-if="pagination.current_page > 1">
            <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
                <span>Atras</span>
            </a>
        </li>
        <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]">
            <a class="page-link" href="#" @click.prevent="changePage(page)" >
                @{{ page }}
            </a>
        </li>
        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
            <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
                <span>Siguiente</span>
            </a>
        </li>
    </ul>
</div>