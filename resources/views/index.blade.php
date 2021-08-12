@extends('layouts.base')

@section('title', 'Тестовое задание CBONDS')

@section('content')
    <div class="wrapper_content">
        <div class="content_scroll">
            <div class="content">
                <div class="content_header">
                    <h2 class="content_ttl">Новая запись</h2>
                </div>
                <div class="infoUser">
                    <div class="field" v-for="field in tableFields" v-bind:id="field" v-if="field != 'action'">
                        <div class="lbl indent">@{{ !!labels[field] ? labels[field] : field }}</div>
                        <div class="fld">
                            <input type="text" class="input" v-model="newItem[field]"/>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <a href="#" @click="appendRow()"  class="btn_green top_10">Добавить</a>
                    <div class="alert alert-danger top_10" v-if="error.display">
                        @{{error.message}}
                    </div>
                </div>
                <div class="content_header top_20">
                    <h2 class="content_ttl">Таблица с данными</h2>
                </div>
                <div v-if="tableData.length">
                    <app-table-new
                        :data="tableData"
                        :fields="tableFields"
                        :fields_labels="labels"
                        :field_customize="fieldCustomize"
                        @if (!empty($auth)) :auth="true" @endif
                        :sum="sum"
                        :no_hidden_empty_cols="true"
                    >
                        <template slot="field" slot-scope="props">
                            @if (!empty($auth))
                                <div v-if="props.field == 'action' && props.row.name != 'Итого' ">
                                    <a href="#" @click="removeRow(props.row.id)">Удалить</a>
                                </div>
                            @endif

                        </template>
                    </app-table-new>

                    <a href="{{ route('export') }}" class="btn_blue top_10">Экспорт в Excel</a>
                </div>
                <div v-else>
                    Нет данных, необходимо добавить
                </div>

            </div>
        </div>
    </div>
@endsection
