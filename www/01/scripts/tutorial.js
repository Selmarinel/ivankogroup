/**
 * Created by Nerdjin on 25.03.2016.
 */
var CommentBox = React.createClass({
    handleCommentSubmit: function(comment) {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            type: 'POST',
            data: comment,
            success: function(data) {
                this.setState({data: data});
            }.bind(this),
            error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    getInitialState: function() {
        return {data: []};
    },
    loadCommentsFromServer: function() {
        $.ajax({
            url: this.props.url,
            dataType: 'json',
            cache: false,
            success: function(data) {
                this.setState({data: data});
            }.bind(this),
            error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
            }.bind(this)
        });
    },
    componentDidMount: function() {
        this.loadCommentsFromServer();
        setInterval(this.loadCommentsFromServer, this.props.pollInterval);
    },
    render: function() {
        return (
            <div className="commentBox">
                <h1>Comments</h1>
                <CommentList data={this.state.data} />
                <CommentForm onCommentSubmit={this.handleCommentSubmit} />
        </div>
        );
    }
});

var CommentList = React.createClass({
    render: function() {
        var commentNodes = this.props.data.map(function(comment) {
            return (
                <Comment user={comment.user} key={comment.id}>
                    {comment.text}
                </Comment>
            );
        });
        return (
            <div className="commentList">
                {commentNodes}
            </div>
        );
    }
});

var CommentForm = React.createClass({
    getInitialState: function() {
        return {user: '', text: ''};
    },
    handleUserChange: function(e) {
        this.setState({user: e.target.value});
    },
    handleTextChange: function(e) {
        this.setState({text: e.target.value});
    },
    handleSubmit: function(e) {
        e.preventDefault();
        var user = this.state.user.trim();
        var text = this.state.text.trim();
        if (!text || !user) {
            return alert('Invalid Data');
        }
        this.props.onCommentSubmit({user: user, text: text});
        this.setState({user: '', text: ''});
    },
    render: function() {
        return (
            <div classUser="commentForm">
                <form className="commentForm" onSubmit={this.handleSubmit}>
                    <input
                        type="text"
                        placeholder="Your user"
                        value={this.state.user}
                        onChange={this.handleUserChange}
                        />
                    <input
                        type="text"
                        placeholder="Say something..."
                        value={this.state.text}
                        onChange={this.handleTextChange}
                        />
                    <input
                        type="submit"
                        value="Post"
                        />
                </form>
            </div>
        );
    }
});

var Comment = React.createClass({
    rawMarkup: function() {
        var rawMarkup = marked(this.props.children.toString(), {sanitize: true});
        return { __html: rawMarkup };
    },
    render: function() {
        return (
            <div className="comment">
                <h2 className="commentUser">
                    {this.props.user}
                </h2>
                <span dangerouslySetInnerHTML={this.rawMarkup()} />
            </div>
        );
    }
});
ReactDOM.render(
<CommentBox url="http://core.loc/site/api/comments" pollInterval={2000}/>,
    document.getElementById('content')
);