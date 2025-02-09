<link rel="stylesheet" type="text/css" href="./css/global.css">
<div class="page">
    <h2>Event Reviews</h2>
    <form action="" method="get" class="search-form">
        <div class="form-group">
            <label for="search">Search Event</label>
            <input type="text" name="search" id="search" class="form-control" placeholder="Enter event name" onkeyup="filterNames()">
        </div>
        <button type="submit" class="btn primary">Search</button>
    </form>
    <div class="events">
        <div class="event">
            <form action="" method="post">
                <div class="form-group">
                    <label for="event">Event</label>
                    <input type="text" name="event" id="event" class="form-control" required value="Wellness Expo">
                </div>
                <div class="form-group">
                    <label for="inquiry">Review</label>
                    <textarea name="inquiry" id="inquiry" class="form-control" required>It was so much fun! Loved the health tips and activities.</textarea>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" name="rating" id="rating" class="form-control" min="0" max="10" required value="9">
                </div>
                <button type="submit" class="btn primary">Reviewed</button>
            </form>
        </div>
        <div class="event">
            <form action="" method="post">
                <div class="form-group">
                    <label for="event">Event</label>
                    <input type="text" name="event" id="event" class="form-control" required value="Environmental Summit">
                </div>
                <div class="form-group">
                    <label for="inquiry">Review</label>
                    <textarea name="inquiry" id="inquiry" class="form-control" required>Learned a lot about environmental challenges and solutions.</textarea>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" name="rating" id="rating" class="form-control" min="0" max="10" required value="8">
                </div>
                <button type="submit" class="btn primary">Reviewed</button>
            </form>
        </div>
        <div class="event">
            <form action="" method="post">
                <div class="form-group">
                    <label for="event">Event</label>
                    <input type="text" name="event" id="event" class="form-control" required value="Fashion Show">
                </div>
                <div class="form-group">
                    <label for="inquiry">Review</label>
                    <textarea name="inquiry" id="inquiry" class="form-control" required>The latest trends were amazing! Loved the creativity.</textarea>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" name="rating" id="rating" class="form-control" min="0" max="10" required value="10">
                </div>
                <button type="submit" class="btn primary">Reviewed</button>
            </form>
        </div>
        <div class="event">
            <form action="" method="post">
                <div class="form-group">
                    <label for="event">Event</label>
                    <input type="text" name="event" id="event" class="form-control" required value="Spring Concert">
                </div>
                <div class="form-group">
                    <label for="inquiry">Review</label>
                    <textarea name="inquiry" id="inquiry" class="form-control" required>Enjoyed the live music and performances.</textarea>
                </div>
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="number" name="rating" id="rating" class="form-control" min="0" max="10" required value="7">
                </div>
                <button type="submit" class="btn primary">Reviewed</button>
            </form>
        </div>
    </div>
</div>

<script>
    function filterNames() {
        var input, filter, events, event, label, i, txtValue;
        input = document.getElementById('search');
        filter = input.value.toUpperCase();
        events = document.getElementsByClassName('event');
        for (i = 0; i < events.length; i++) {
            event = events[i];
            label = event.querySelector('input[name="event"]');
            txtValue = label.value || label.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                event.style.display = "";
            } else {
                event.style.display = "none";
            }
        }
    }
</script>
