<label for="pasteSyntax">Syntax Highlighting</label>
<select class="form-control" name="syntaxhighlighting" id="syntaxhighlighting">
  <option value="0" selected="selected">None</option>
  @foreach ($pastes as $paste)
    <option value="{{$paste->syntax_id}}">{{ $paste->syntax_name }}</option>
  @endforeach
</select>
