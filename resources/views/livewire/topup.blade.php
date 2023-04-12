<div>
    <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!</p>
    <div class="flex flex-col gap-6">
        <select wire:model="bank_id" class="select select-warning w-full select-banking">
            <option value="0" selected>Pick a banks</option>
            @foreach($bank as $b)
            <option value="{{$b->id}}">{{$b->bank_name}} - {{$b->bank_number}} - {{$b->user_name}}</option>
            @endforeach
        </select>
        <input type="number" wire:model="money" placeholder="Enter money" class="input input-bordered input-warning w-full input-warning-custom" />

        <div class="modal-action">
            <label for="my-modal" class="btn">Close</label>
            <label class="btn btn-success" wire:click="top_up">Top Up</label>
        </div>
    </div>

</div>